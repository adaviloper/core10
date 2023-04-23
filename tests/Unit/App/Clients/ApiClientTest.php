<?php

namespace Tests\Unit\App\Clients;

use App\Clients\FakeClient;
use PHPUnit\Framework\TestCase;

class ApiClientTest extends TestCase
{
    /** @test */
    public function it_prepares_the_resource_url_to_be_used_by_the_client()
    {
        $this->assertEquals('some/path', FakeClient::sanitizeUrl('https://swapi.dev/api/some/path'));
    }
}
