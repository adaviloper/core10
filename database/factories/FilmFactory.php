<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = $this->faker->numberBetween(1, 100);
        return [
            'id' => $id,
            'episode_id' => $this->faker->numberBetween(1, 9),
            'url' => "https://swapi.dev/api/films/{$id}",
        ];
    }
}
