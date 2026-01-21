<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountAnalytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'username',
        'followers_count',
        'following_count',
        'total_likes',
        'engagement_rate',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'date',
        'engagement_rate' => 'decimal:2',
    ];

    /**
     * Scope: data per platform
     */
    public function scopePlatform($query, string $platform)
    {
        return $query->where('platform', $platform);
    }
}
