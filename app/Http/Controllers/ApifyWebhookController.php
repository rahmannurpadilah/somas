<?php

namespace App\Http\Controllers;

use App\Models\ContentSources;
use App\Models\ContentIdeas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApifyWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('APIFY WEBHOOK MASUK', [
            'query' => $request->query(),
            'payload_keys' => array_keys($request->all()),
        ]);

        $sourceId = $request->query('source_id');
        $datasetId = data_get($request->all(), 'resource.defaultDatasetId');

        Log::info('APIFY PARSE PARAMS', [
            'sourceId' => $sourceId,
            'datasetId' => $datasetId,
        ]);

        if (! $datasetId || ! $sourceId) {
            Log::warning('APIFY: missing datasetId or sourceId', [
                'datasetId' => $datasetId,
                'sourceId' => $sourceId,
            ]);
            return response()->json(['status' => 'invalid']);
        }

        $source = ContentSources::find($sourceId);
        if (! $source) {
            Log::warning('APIFY: source not found', ['sourceId' => $sourceId]);
            return response()->json(['status' => 'source_not_found']);
        }

        Log::info('APIFY: source found', ['platform' => $source->platform]);

        // Fetch dataset items dari Apify
        $items = $this->fetchDatasetItems($datasetId);

        Log::info('APIFY: items fetched', [
            'total_items' => count($items),
            'datasetId' => $datasetId,
        ]);

        if (empty($items)) {
            Log::warning('APIFY: dataset empty');
            return response()->json(['status' => 'no_items']);
        }

        $inserted = 0;
        $skipped = 0;

        foreach ($items as $item) {
            // Extract URL based on platform
            $url = $item['url'] ?? $item['webVideoUrl'] ?? null;
            $caption = $item['caption'] ?? $item['text'] ?? '';

            // Get views/plays
            $views = $item['playCount'] ?? $item['viewCount'] ?? 0;

            // Get likes based on platform
            if ($source->platform === 'tiktok') {
                $likes = $item['diggCount'] ?? 0;
            } else {
                $likes = $item['likesCount'] ?? 0;
            }

            // Filter: TikTok views < 10k, Instagram likes < 100
            if ($source->platform === 'tiktok' && $views < 10000) {
                Log::debug('APIFY SKIP TIKTOK', ['views' => $views]);
                $skipped++;
                continue;
            }
            if ($source->platform === 'instagram' && $likes < 100) {
                Log::debug('APIFY SKIP INSTAGRAM', ['likes' => $likes]);
                $skipped++;
                continue;
            }

            try {
                Log::info('APIFY CREATE ITEM', [
                    'url' => $url,
                    'platform' => $source->platform,
                    'caption_len' => strlen($caption),
                ]);

                ContentIdeas::create([
                    'source_id' => $sourceId,
                    'platform' => $source->platform,
                    'original_url' => $url,
                    'original_caption' => $caption,
                    'original_stats' => [
                        'views' => $views,
                        'likes' => $likes,
                        'comments' => $item['commentCount'] ?? $item['commentsCount'] ?? 0,
                        'shares' => $item['shareCount'] ?? 0,
                    ],
                    'status' => 'draft',
                ]);
                $inserted++;
            } catch (\Exception $e) {
                Log::error('APIFY CREATE ERROR', [
                    'error' => $e->getMessage(),
                    'url' => $url,
                ]);
            }
        }

        Log::info('APIFY WEBHOOK DONE', [
            'inserted' => $inserted,
            'skipped' => $skipped,
            'total' => count($items),
            'source_id' => $sourceId,
            'platform' => $source->platform,
        ]);

        return response()->json(['status' => 'ok']);
    }

    private function fetchDatasetItems(string $datasetId): array
    {
        $token = config('services.apify.token');

        try {
            $response = Http::get(
                "https://api.apify.com/v2/datasets/{$datasetId}/items",
                [
                    'clean' => true,
                    'format' => 'json',
                    'token' => $token,
                ]
            );

            if (! $response->successful()) {
                Log::error('APIFY FETCH ERROR', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return [];
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error('APIFY FETCH EXCEPTION', [
                'error' => $e->getMessage(),
            ]);
            return [];
        }
    }
}
