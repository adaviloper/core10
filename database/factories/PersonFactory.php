<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Starship;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
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
            'name' => $this->faker->name(),
            'homeworld' => $this->faker->word(),
            'url' => "https://swapi.dev/api/people/{$id}",
        ];
    }

    public function withFilms(int $count = 1): Factory
    {
        return $this->state(function (array $attributes) use ($count) {
            return Film::factory()
                ->count($count)
                ->create()
                ->pluck('url')
                ->toArray()
                ;
        });
    }

    public function withStarships(int $count = 1): Factory
    {
        return $this->state(function (array $attributes) use ($count) {
            return Starship::factory()
                ->count($count)
                ->create()
            ;
        });
    }
}
