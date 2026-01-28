<?php

namespace App\Jobs;

use App\Models\ContentSources;
use App\Services\ApifyService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TriggerApifyScrape implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public ContentSources $source
    ) {}

    public function handle(ApifyService $apify): void
    {
        Log::info('Trigger Apify Scrape', [
            'source_id' => $this->source->id,
        ]);

        $apify->runScraper($this->source);
    }
}
