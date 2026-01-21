<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSourceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('content_sources')->insert([
            [
                'platform' => 'tiktok',
                'type' => 'username',
                'identifier' => 'akunviral.id',
                'category' => 'viral',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'platform' => 'instagram',
                'type' => 'hashtag',
                'identifier' => 'kulinerjakarta',
                'category' => 'kuliner',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
