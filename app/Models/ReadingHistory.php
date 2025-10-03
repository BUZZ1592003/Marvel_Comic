<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ReadingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comic_id',
        'last_read_page',
        'is_completed',
        'started_reading_at',
        'last_read_at'
    ];

    protected $casts = [
        'last_read_page' => 'integer',
        'is_completed' => 'boolean',
        'started_reading_at' => 'datetime',
        'last_read_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comic(): BelongsTo
    {
        return $this->belongsTo(Comic::class);
    }

    // Progress percentage
    public function getProgressPercentageAttribute()
    {
        return round(($this->last_read_page / $this->comic->page_count) * 100);
    }
}
