<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentIdeaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('content_ideas')->insert([
            [
                'source_id' => 1,
                'platform' => 'tiktok',
                'original_url' => 'https://www.tiktok.com/@akunviral.id/video/123456',
                'original_caption' => 'This product changed my life in 7 days!',
                'original_stats' => json_encode([
                    'likes' => 120000,
                    'views' => 1500000,
                    'comments' => 2300,
                ]),

                'ai_generated_caption' => null,
                'ai_generated_script' => null,
                'ai_status' => 'pending',
                'ai_error_message' => null,

                'final_caption' => null,
                'final_media_path' => null,
                'admin_notes' => null,
                'status' => 'draft',

                'scheduled_at' => null,
                'approved_at' => null,
                'posted_at' => null,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'source_id' => 2,
                'platform' => 'instagram',
                'original_url' => 'https://www.instagram.com/p/ABCDEF/',
                'original_caption' => 'Street food Jakarta paling rame!',
                'original_stats' => json_encode([
                    'likes' => 45000,
                    'views' => 300000,
                ]),

                'ai_generated_caption' => 'Jajan favorit warga Jakarta yang selalu rame tiap sore!',
                'ai_generated_script' => 'Opening: tunjuk antrian panjang...',
                'ai_status' => 'completed',
                'ai_error_message' => null,

                'final_caption' => 'Jajan favorit warga Jakarta yang selalu rame tiap sore!',
                'final_media_path' => null,
                'admin_notes' => null,
                'status' => 'reviewed',

                'scheduled_at' => null,
                'approved_at' => now(),
                'posted_at' => null,

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
