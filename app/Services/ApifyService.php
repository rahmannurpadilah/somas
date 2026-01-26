<?php

namespace App\Services;

use App\Models\ContentSources;
use Illuminate\Support\Facades\Http;

class ApifyService
{
    public function runScraper(ContentSources $source): void
    {
        $actor = $source->platform === 'instagram'
            ? config('services.apify.instagram_actor')
            : config('services.apify.tiktok_actor');

        Http::withToken(config('services.apify.token'))
            ->post("https://api.apify.com/v2/acts/{$actor}/runs", [
                'input' => [
                    'usernames' => [$source->identifier],
                ],
                'webhook' => [
                    'eventTypes' => ['ACTOR.RUN.SUCCEEDED'],
                    'requestUrl' => route('apify.webhook'),
                    'payloadTemplate' => json_encode([
                        'source_id' => $source->id,
                        'items' => '{{resource.defaultDataset.items}}'
                    ]),
                ],
            ]);
    }
}

