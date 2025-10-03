<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = Str::title($this->faker->unique()->words(2, true));
        $types = ['hero','villain','antihero','neutral'];
        $stat = fn() => $this->faker->numberBetween(40, 100);


        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'description' => $this->faker->paragraphs(2, true),
            'real_name' => $this->faker->name(),
            'alias' => $this->faker->optional()->userName(),
            'image_url' => $this->faker->imageUrl(600, 600, 'character', true),
            'thumbnail_url' => $this->faker->imageUrl(300, 300, 'character', true),
            'powers' => $this->faker->randomElements([
                'Super Strength','Agility','Web-Slinging','Flight','Telepathy',
                'Telekinesis','Energy Projection','Healing Factor','Invisibility'
            ], $this->faker->numberBetween(1, 4)),
            'first_appearance' => 'Issue #' . $this->faker->numberBetween(1, 500),
            'type' => $this->faker->randomElement($types),
            'origin' => $this->faker->country(),
            'teams' => $this->faker->randomElements([
                'Avengers','X-Men','Fantastic Four','Defenders','Guardians of the Galaxy'
            ], $this->faker->numberBetween(0, 2)),
            'strength' => $stat(),
            'intelligence' => $stat(),
            'speed' => $stat(),
            'durability' => $stat(),
            'energy_projection' => $stat(),
            'fighting_skills' => $stat(),
            'status' => $this->faker->randomElement(['active','inactive','deceased']),
        ];
    }
}
