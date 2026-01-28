<?php

namespace App\Console\Commands;

use App\Models\ContentSources;
use App\Models\ContentIdeas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchApifyDataset extends Command
{
    protected $signature = 'apify:fetch {datasetId} {sourceId}';
    protected $description = 'Manually fetch and save Apify dataset items to database';

    public function handle()
    {
        $datasetId = $this->argument('datasetId');
        $sourceId = $this->argument('sourceId');

        $this->info("Fetching dataset: {$datasetId} for source: {$sourceId}");

        $source = ContentSources::find($sourceId);
        if (! $source) {
            $this->error('Source not found!');
            return 1;
        }

        $this->info("Source found: {$source->platform} - {$source->identifier}");

        $token = config('services.apify.token');
        $url = "https://api.apify.com/v2/datasets/{$datasetId}/items";

        $this->info("Fetching from: {$url}");

        try {
            $response = Http::get($url, [
                'clean' => true,
                'format' => 'json',
                'token' => $token,
            ]);

            if (!$response->successful()) {
                $this->error("Failed to fetch: " . $response->status());
                return 1;
            }

            $items = $response->json();
            $this->info("Fetched " . count($items) . " items");

            $inserted = 0;
            $skipped = 0;

            $bar = $this->output->createProgressBar(count($items));
            $bar->start();

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
                    $skipped++;
                    $bar->advance();
                    continue;
                }
                if ($source->platform === 'instagram' && $likes < 100) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }

                try {
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
                    $this->error("Error: " . $e->getMessage());
                }

                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
            $this->info("✅ Inserted: {$inserted}");
            $this->info("⏭️  Skipped: {$skipped}");

            return 0;
        } catch (\Exception $e) {
            $this->error("Exception: " . $e->getMessage());
            return 1;
        }
    }
}
