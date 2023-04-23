<?php

namespace Tests\Feature\App\Models;

use App\Models\Person;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonTest extends TestCase
{
    /** @test */
    public function persons_can_generate_their_own_endpoints()
    {
        $person = Person::factory()->make();

        $this->assertEquals("swapi.dev/people/{$person->id}", $person->resourcePath);
    }
}
