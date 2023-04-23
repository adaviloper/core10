<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planet>
 */
class PlanetFactory extends Factory
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
            'url' => "https://swapi.dev/api/planets/{$id}",
            'population' => $this->faker->numberBetween(1, 1000)
        ];
    }
}
