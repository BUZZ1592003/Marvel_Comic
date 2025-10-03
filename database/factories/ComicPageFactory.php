<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comic;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class ComicPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comic_id' => Comic::factory(),
            'page_number' => $this->faker->numberBetween(1, 32),
            'image_url' => $this->faker->imageUrl(1200, 1800, 'page', true),
            'alt_text' => $this->faker->sentence(),
        ];
    }
}
