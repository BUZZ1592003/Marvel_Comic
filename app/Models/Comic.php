<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comic extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'series_id',
        'title',
        'slug',
        'description',
        'cover_image',
        'issue_number',
        'release_date',
        'writer',
        'artist',
        'colorist',
        'letterer',
        'page_count',
        'price',
        'rating',
        'rating_count',
        'status',
        'is_featured'
    ];

    protected $casts = [
        'release_date' => 'date',
        'page_count' => 'integer',
        'price' => 'decimal:2',
        'rating' => 'decimal:2',
        'rating_count' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class)->withPivot('role')->withTimestamps();
    }

    public function pages(): HasMany
    {
        return $this->hasMany(ComicPage::class)->orderBy('page_number');
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('release_date', 'desc');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFullTitleAttribute()
    {
        return $this->series->name . ' #' . $this->issue_number . ': ' . $this->title;
    }
}
