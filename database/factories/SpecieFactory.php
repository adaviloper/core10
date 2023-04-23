<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Specie>
 */
class SpecieFactory extends Factory
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
            'classification' => $this->faker->word,
            'url' => "https://swapi.dev/api/species/{$id}",
        ];
    }
}
