<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Clients\ApiClient;
use App\Clients\FakeClient;
use App\Clients\SWClient;
use App\Models\Film;
use App\Models\Person;
use App\Models\Planet;
use App\Models\Specie;
use App\Models\Starship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class StarWarsResourceControllerTest extends TestCase
{
    private FakeClient $apiClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiClient = new FakeClient();
        $this->app->instance(ApiClient::class, $this->apiClient);
    }

    /** @test */
    public function it_should_call_the_star_wars_api_starships_resource()
    {
        Http::fake();
        $this->app->instance(ApiClient::class, new SWClient());

        $this->getJson('api/sw/starships');

        Http::assertSent(function(Request $r) {
            return Str::endsWith($r->url(), 'starships');
        });
    }

    /** @test */
    public function invalid_resources_should_return_a_404()
    {
        Http::fake();

        $response = $this->getJson('api/sw/invalid-resource');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_retrieve_an_individual_record_by_id()
    {
        $person = Person::factory()->make();
        $this->apiClient->addResource('people', $person);

        $response = $this->getJson("api/sw/people/{$person->id}");

        $response->assertJsonFragment($person->toArray());
    }

    /** @test */
    public function it_can_return_a_persons_starships()
    {
        $this->withoutExceptionHandling();
        $starShipA = Starship::factory()->make();
        $starShipB = Starship::factory()->make();
        $person = Person::factory()->make([
            'starships' => [
                $starShipA->url,
                $starShipB->url,
            ]
        ]);
        $this->apiClient->addResource('people', $person);
        $this->apiClient->addResource('starships', $starShipA);
        $this->apiClient->addResource('starships', $starShipB);

        $response = $this->getJson("api/sw/people/{$person->id}/starships");

        $response->assertJsonFragment($starShipA->toArray());
        $response->assertJsonFragment($starShipB->toArray());
    }

    /** @test */
    public function it_can_list_a_films_species()
    {
        $species = Specie::factory()->count(3)->make();
        $film = Film::factory()->make([
            'species' => $species->pluck('url')->toArray(),
            'episode_id' => 4,
        ]);
        $this->apiClient->addResource('films', $film);
        $species->each(function ($specie) {
            $this->apiClient->addResource('species', $specie);
        });

       $response = $this->getJson("api/sw/films/{$film->id}/species");

       $response->assertContent(
           $species->pluck('classification')
               ->unique()
               ->values()
               ->toJson()
       );
    }

    /** @test */
    public function it_can_calculate_the_population_of_the_galaxy()
    {
        $planets = Planet::factory()->count(5)->make();
        $planets->each(function ($planet) {
            $this->apiClient->addResource('planets', $planet);
        });

        $response = $this->getJson('api/sw/planets/population');

        $this->assertEquals($response->content(), $planets->sum('population'));
    }
}
