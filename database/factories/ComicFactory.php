<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Series;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class ComicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = Str::title($this->faker->unique()->words(2, true));
        return [
            'series_id' => Series::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'description' => $this->faker->paragraphs(2, true),
            'cover_image' => $this->faker->imageUrl(600, 900, 'cover', true),
            'issue_number' => $this->faker->numberBetween(1, 999),
            'release_date' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
            'writer' => $this->faker->name(),
            'artist' => $this->faker->name(),
            'colorist' => $this->faker->optional()->name(),
            'letterer' => $this->faker->optional()->name(),
            'page_count' => $this->faker->numberBetween(18, 32),
            'price' => $this->faker->randomFloat(2, 2.99, 9.99),
            'rating' => $this->faker->randomFloat(2, 3.0, 5.0),
            'rating_count' => $this->faker->numberBetween(0, 5000),
            'status' => $this->faker->randomElement(['published','upcoming']),
            'is_featured' => $this->faker->boolean(10),
        ];
    }
}
