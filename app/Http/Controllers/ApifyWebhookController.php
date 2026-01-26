<?php

namespace App\Http\Controllers;

use App\Models\ContentIdeas;
use Illuminate\Http\Request;

class ApifyWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $sourceId = $request->input('source_id');
        $items = $request->input('items', []);

        foreach ($items as $item) {

            // FILTER: buang konten kecil
            if (($item['playCount'] ?? 0) < 10000) {
                continue;
            }

            ContentIdeas::create([
                'source_id' => $sourceId,
                'original_url' => $item['url'] ?? null,
                'original_caption' => $item['caption'] ?? '',
                'original_stats' => [
                    'views' => $item['playCount'] ?? 0,
                    'likes' => $item['likeCount'] ?? 0,
                ],
                'status' => 'draft',
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
}

