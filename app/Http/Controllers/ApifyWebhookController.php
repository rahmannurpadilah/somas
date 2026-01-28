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
        $datasetId = $request->input('data.resource.defaultDatasetId');
        $sourceId = $request->query('source_id');

        Log::info('APIFY WEBHOOK HIT', [
            'datasetId' => $datasetId,
            'sourceId' => $sourceId,
        ]);

        if (! $datasetId || ! $sourceId) {
            return response()->json(['error' => 'datasetId/source_id missing'], 400);
        }

        $source = ContentSources::find($sourceId);
        if (! $source) {
            return response()->json(['error' => 'source not found'], 404);
        }

        $token = config('services.apify.token');
        $itemsUrl = "https://api.apify.com/v2/datasets/{$datasetId}/items?token={$token}";

        $items = Http::acceptJson()->get($itemsUrl)->json() ?? [];

        foreach ($items as $item) {
            // Filter sederhana untuk TikTok: skip kalau views < 10k
            if ($source->platform === 'tiktok' && ($item['playCount'] ?? 0) < 10000) {
                continue;
            }

            ContentIdeas::create([
                'source_id' => $sourceId,
                'original_url' => $item['url'] ?? $item['webUrl'] ?? null,
                'original_caption' => $item['caption'] ?? $item['text'] ?? '',
                'original_stats' => [
                    'views' => $item['playCount'] ?? $item['viewCount'] ?? 0,
                    'likes' => $item['likeCount'] ?? $item['likes'] ?? 0,
                ],
                'status' => 'draft',
            ]);
        }

        Log::info('APIFY WEBHOOK DONE', [
            'inserted' => count($items),
            'sourceId' => $sourceId,
        ]);

        return response()->json(['status' => 'ok']);
    }
}

