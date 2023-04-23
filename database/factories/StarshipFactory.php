<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Starship>
 */
class StarshipFactory extends Factory
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
            'name' => $this->faker->slug(),
            'model' => $this->faker->slug(),
            'manufacturer' => $this->faker->sentence(3),
            'url' => "https://swapi.dev/api/starships/{$id}",
        ];
    }
}
