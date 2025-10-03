<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Series extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_url',
        'start_year',
        'end_year',
        'status',
        'publisher',
        'genre',
        'total_issues',
        'frequency',
        'average_rating',
        'popularity_score'
    ];

    protected $casts = [
        'start_year'=>'integer',
        'end_year'=>'integer',
        'total_issues'=>'integer',
        'average_rating'=>'decimal:2',
        'popularity_score'=>'integer',
    ];

    protected $table = 'series';

    public function comics():HasMany
    {
        return $this->hasMany(Comic::class);
    }

    public function favorites():MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', 'ongoing');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('popularity_score', 'desc');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDurationAttribute()
    {
       if ($this->end_year) {
            return $this->end_year - $this->start_year . ' years';
        }
        return (date('Y') - $this->start_year) . ' years (ongoing)';
    }
}