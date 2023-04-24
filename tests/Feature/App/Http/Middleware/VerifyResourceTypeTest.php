<?php

namespace Tests\Feature\App\Http\Middleware;

use App\Http\Middleware\VerifyResourceType;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class VerifyResourceTypeTest extends TestCase
{
    /** @test */
    public function it_should_throw_an_exception_for_requests_with_valid_resource_types()
    {
        $this->withoutExceptionHandling()
            ->expectException(NotFoundHttpException::class);

        $this->getJson('api/sw/invalid-resource-type/2');
    }

    /** @test */
    public function it_should_only_allow_requests_for_valid_resource_types()
    {
        $this->withoutExceptionHandling();
        Http::fake();

        $response = $this->getJson('api/sw/' . Resource::PLANETS_TYPE);

        $response->assertOk();
    }
}
