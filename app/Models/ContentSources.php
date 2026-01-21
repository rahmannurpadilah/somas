<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentSources extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'type',
        'identifier',
        'category',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi: 1 source punya banyak content idea
     */
    public function contentIdeas()
    {
        return $this->hasMany(ContentIdeas::class, 'source_id');
    }
}
