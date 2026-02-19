<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerNote extends Model 
{
    protected $fillable = [
        'player_id', 
        'author_id', 
        'content'
    ];

    /**
     * Relationship: The author of the note (agent).
     */
    public function author(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Relationship: The player the note is about.
     */
    public function player(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'player_id');
    }
}