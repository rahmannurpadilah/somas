<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccountAnalyticsSeeder extends Seeder
{
    public function run(): void
    {
        $dates = collect(range(0, 6))->map(fn ($i) =>
            Carbon::now()->subDays($i)->toDateString()
        );

        foreach ($dates as $date) {
            DB::table('account_analytics')->insert([
                'platform' => 'tiktok',
                'username' => 'brandkamu.id',
                'followers_count' => rand(10000, 12000),
                'following_count' => rand(100, 200),
                'total_likes' => rand(50000, 70000),
                'engagement_rate' => rand(30, 80) / 10,
                'recorded_at' => $date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
