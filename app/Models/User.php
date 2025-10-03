<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use CrudTrait;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function readingHistory(): HasMany
    {
        return $this->hasMany(ReadingHistory::class);
    }

    public function followedSeries(): BelongsToMany
    {
        return $this->belongsToMany(Series::class, 'series_followers')
                    ->withPivot('notifications_enabled')
                    ->withTimestamps();
    }

    // Helper methods
    public function hasFavorited($model)
    {
        return $this->favorites()
                    ->where('favoritable_type', get_class($model))
                    ->where('favoritable_id', $model->id)
                    ->exists();
    }

    public function hasRated($model)
    {
        return $this->ratings()
                    ->where('rateable_type', get_class($model))
                    ->where('rateable_id', $model->id)
                    ->exists();
    }

    public function getReadingProgressAttribute()
    {
        return $this->readingHistory()
                    ->where('is_completed', true)
                    ->count();
    }

    public function favoriteCharacters()
    {
        return $this->favorites()
                    ->where('favoritable_type', Character::class)
                    ->with('favoritable');
    }

    public function favoriteComics()
    {
        return $this->favorites()
                    ->where('favoritable_type', Comic::class)
                    ->with('favoritable');
    }
}