<?php

namespace Tests\Feature\App\Models;

use App\Clients\ApiClient;
use App\Clients\FakeClient;
use App\Models\Person;
use App\Models\Resource;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    private FakeClient $apiClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->apiClient = new FakeClient();
        $this->app->instance(ApiClient::class, $this->apiClient);
    }

    /** @test */
    public function resources_can_be_auto_resolved_from_the_url()
    {
        $person = Person::factory()->make();
        $this->apiClient->addResource('people', $person);
        $request = new Request([], [], [], [], [], ['REQUEST_URI' => "api/sw/people/{$person->id}"]);

        request()->setRouteResolver(function () use ($request) {
            return (new Route('GET', 'api/sw/{resourceType}/{id}', []))->bind($request);
        });
        $resolvedPerson = (new Resource())->resolveRouteBinding($person->id);

        $this->assertEquals($resolvedPerson->url, $person->url);
    }
}
