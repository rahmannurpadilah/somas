<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromptTemplateSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prompt_templates')->insert([
            [
                'name' => 'Rewrite Viral TikTok (Indonesia)',
                'prompt_body' => 
"Act as a professional Indonesian social media strategist.

Rewrite the following content into Indonesian language that is:
- Casual
- Gen Z friendly
- Soft selling (no hard selling)
- Suitable for TikTok audience in Indonesia

Original Content:
{{content}}

Return the result in this format:
Caption:
Hashtags:
Video Hook Idea:",
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
