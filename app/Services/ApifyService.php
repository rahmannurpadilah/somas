<?php

namespace App\Services;

use App\Models\ContentSources;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class ApifyService
{
    public function runScraper(ContentSources $source): array
    {
        $isInstagram = $source->platform === 'instagram';
        $isInstagramHashtag = $isInstagram
            && (($source->type === 'hashtag') || str_starts_with($source->identifier, '#'));

        $actor = match (true) {
            $isInstagramHashtag => config('services.apify.instagram_hashtag_actor', config('services.apify.instagram_actor')),
            $isInstagram        => config('services.apify.instagram_actor'),
            default             => config('services.apify.tiktok_actor'),
        };

        $token = config('services.apify.token');

        $input = $this->buildInput($source);

        $payload = array_merge($input, [
            'webhooks' => [[
                'eventTypes' => ['ACTOR.RUN.SUCCEEDED'],
                'requestUrl' => route('apify.webhook', ['source_id' => $source->id]),
            ]],
        ]);

        Log::info('APIFY FINAL PAYLOAD', $payload);

        $url = "https://api.apify.com/v2/acts/{$actor}/runs?token={$token}";

        $response = Http::acceptJson()->post($url, $payload);

        Log::info('APIFY RESPONSE', [
            'status' => $response->status(),
            'body' => $response->json(),
        ]);

        return $this->filterByViews($response->json());
    }


    /**
     * Normalisasi input biar cocok sama actor
     */
    private function buildInput(ContentSources $source): array
    {
        if ($source->platform === 'instagram') {
            $identifier = ltrim($source->identifier, '@#');

            // Allow Instagram to scrape either by username (default) or by hashtag
            // based on the source type / identifier format.
            $isHashtag = ($source->type === 'hashtag') || str_starts_with($source->identifier, '#');

            if ($isHashtag) {
                return [
                    // Instagram hashtag scraper: fetch top 10 viral posts sorted by engagement
                    'hashtags'      => [$identifier],
                    'keywordSearch' => false,
                    'resultsLimit'  => 10,
                    'resultsType'   => 'posts',
                ];
            }

            // Instagram username flow: fetch top 10 viral posts from profile (sorted by engagement)
            return [
                'searchType'    => 'hashtag',
                'directUrls'    => ["https://www.instagram.com/{$identifier}/"],
                'resultsType'   => 'posts',
                'resultsLimit'  => 10,
                'searchLimit'   => 1,
                'addParentData' => false,
            ];
        }

        if ($source->platform === 'tiktok') {
            $identifier = ltrim($source->identifier, '@#');

            // Allow TikTok to scrape either by username (default) or by hashtag
            // based on the source type / identifier format.
            $isHashtag = ($source->type === 'hashtag') || str_starts_with($source->identifier, '#');

            if ($isHashtag) {
                return [
                    // TikTok hashtag scraping: fetch top 10 most viral videos sorted by popularity
                    'commentsPerPost'                 => 0,
                    'excludePinnedPosts'              => false,
                    'hashtags'                        => [$identifier],
                    'maxFollowersPerProfile'          => 0,
                    'maxFollowingPerProfile'          => 0,
                    'maxRepliesPerComment'            => 0,
                    'proxyCountryCode'                => 'None',
                    'resultsPerPage'                  => 10,
                    'scrapeRelatedVideos'             => false,
                    'shouldDownloadAvatars'           => false,
                    'shouldDownloadCovers'            => false,
                    'shouldDownloadMusicCovers'       => false,
                    'shouldDownloadSlideshowImages'   => false,
                    'shouldDownloadSubtitles'         => false,
                    'shouldDownloadVideos'            => false,
                    'profileScrapeSections'           => ['videos'],
                    'profileSorting'                  => 'popular',
                    'searchSection'                   => '',
                    'maxProfilesPerQuery'             => 10,
                    'searchSorting'                   => '0',
                    'searchDatePosted'                => '0',
                ];
            }

            // TikTok username flow: fetch top 10 most viral videos from profile sorted by popularity
            return [
                'commentsPerPost'                 => 0,
                'excludePinnedPosts'              => false,
                'leastDiggs'                      => 1000,
                'maxFollowersPerProfile'          => 0,
                'maxFollowingPerProfile'          => 0,
                'maxRepliesPerComment'            => 0,
                'profileScrapeSections'           => ['videos'],
                'profileSorting'                  => 'popular',
                'profiles'                        => [$identifier],
                'proxyCountryCode'                => 'None',
                'resultsPerPage'                  => 10,
                'scrapeRelatedVideos'             => false,
                'searchQueries'                   => [],
                'shouldDownloadAvatars'           => false,
                'shouldDownloadCovers'            => false,
                'shouldDownloadMusicCovers'       => false,
                'shouldDownloadSlideshowImages'   => false,
                'shouldDownloadSubtitles'         => false,
                'shouldDownloadVideos'            => false,
                'searchSection'                   => '',
                'maxProfilesPerQuery'             => 10,
                'searchSorting'                   => '0',
                'searchDatePosted'                => '0',
            ];
        }

        return [];
    }

    /**
     * Filter konten yang minimal punya 10k views.
     * Menangani respons baik array langsung maupun key "items".
     */
    private function filterByViews($data): array
    {
        // Apify sometimes wraps in ['items' => [...]]; support both shapes
        $items = $data['items'] ?? $data;

        if (!is_array($items)) {
            return $data;
        }

        $MIN_VIEWS = 10000;
        $filtered = [];

        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }

            // Normalize views field across Instagram/TikTok payloads
            $views = $item['playCount']
                ?? $item['plays']
                ?? $item['videoPlayCount']
                ?? $item['videoViewCount']
                ?? $item['viewCount']
                ?? $item['views']
                ?? 0;

            // Keep only items with at least 10k views
            if ($views >= $MIN_VIEWS) {
                $filtered[] = $item;
            }
        }

        // Preserve original envelope if existed
        return array_key_exists('items', $data)
            ? array_merge($data, ['items' => $filtered])
            : $filtered;
    }

}
