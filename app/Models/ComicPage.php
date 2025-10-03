<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComicPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'comic_id',
        'page_number',
        'image_url',
        'alt_text'
    ];

    protected $casts = [
        'page_number' => 'integer',
    ];

    // Relationships
    public function comic(): BelongsTo
    {
        return $this->belongsTo(Comic::class);
    }
    
}
