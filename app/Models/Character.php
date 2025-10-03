<?php
namespace Database\Factories;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTomany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Backpack\CRUD\app\Models\Traits\CrudTrait;


class Character extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'real_name',
        'alias',
        'image_url',
        'thumbnail_url',
        'powers',
        'first_appearance',
        'type',
        'origin',
        'teams',
        'strength',
        'intelligence',
        'speed',
        'durability',
        'energy_projection',
        'fighting_skills',
        'status'
    ];

    protected $casts = [
        'powers'=>'array',
        'teams'=>'array',
        'strength'=>'integer',
        'intelligence'=>'integer',
        'speed'=>'integer',
        'durability'=>'integer',
        'energy_projection'=>'integer',
        'fighting_skills'=>'integer',
    ];

    public function comics(): BelongsToMany
    {
        return $this->belongsToMany(Comic::class)->withPivot('role')->withTimestamps();
    }
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Favorite::class, 'favoritable');
    }

    public function scopeHeros($query){

        return $query->where('type', 'hero');
    }

    public function scopeVillains($query)
    {
        return $query->where('type', 'villain');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }   

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getAvergaeStatsAttribute()
    {
        return round(($this->strength + $this->intelligence + $this->speed + $this->durability + $this->energy_projection + $this->fighting_skills) / 6);
    }
}
