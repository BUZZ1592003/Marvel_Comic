<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class SeriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'description' => $this->faker->paragraphs(3, true),
            'image_url' => $this->faker->imageUrl(800, 400, 'comics', true),
            'start_year' => $this->faker->numberBetween(1960, now()->year - 1),
            'end_year' => $this->faker->optional(0.3)->numberBetween(1990, now()->year),
            'status' => $this->faker->randomElement(['ongoing', 'completed', 'hiatus']),
            'publisher' => 'Marvel Comics',
            'genre' => $this->faker->randomElement(['superhero','action','adventure','sci-fi','fantasy']),
            'total_issues' => 0,
            'frequency' => $this->faker->randomElement(['Monthly','Bi-weekly','Weekly']),
            'average_rating' => $this->faker->randomFloat(2, 3.5, 5.0),
            'popularity_score' => $this->faker->numberBetween(10, 100),
        ];
    }
}
