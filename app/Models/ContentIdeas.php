<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentIdeas extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_id',
        'platform',

        'original_url',
        'original_caption',
        'original_stats',

        'ai_generated_caption',
        'ai_generated_script',
        'ai_status',
        'ai_error_message',

        'final_caption',
        'final_media_path',
        'admin_notes',
        'status',

        'scheduled_at',
        'approved_at',
        'posted_at',
    ];

    protected $casts = [
        'original_stats' => 'array',
        'scheduled_at'   => 'datetime',
        'approved_at'    => 'datetime',
        'posted_at'      => 'datetime',
    ];

    /**
     * Relasi ke ContentSource
     */
    public function source()
    {
        return $this->belongsTo(ContentSources::class, 'source_id');
    }

    /**
     * Scope: konten siap dipost
     */
    public function scopeReadyToSchedule($query)
    {
        return $query->where('status', 'reviewed')
                     ->whereNotNull('final_caption');
    }

    /**
     * Helper: apakah AI sukses
     */
    public function isAiCompleted(): bool
    {
        return $this->ai_status === 'completed';
    }
}
