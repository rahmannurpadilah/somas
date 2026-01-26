<?php

namespace App\Jobs;

use App\Models\ContentSources;
use App\Services\ApifyService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class TriggerApifyScrape implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(
        public ContentSources $source
    ) {}

    public function handle(ApifyService $apify)
    {
        $apify->runScraper($this->source);
    }
}
