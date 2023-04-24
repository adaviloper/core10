<?php

namespace App\Http\Controllers;

use App\Clients\ApiClient;
use App\Clients\SWClient;
use App\Models\Person;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StarWarsResourceController extends Controller
{
    public function __construct(
        protected ApiClient $apiClient
    ) {
    }

    public function index(string $resourceType)
    {
        return $this->apiClient->get("$resourceType");
    }

    public function find(Request $request, string $resourceType, Resource $resource)
    {
        return $resource;
    }

    public function question(string $resourceType, Resource $resource, $question)
    {
        return $resource->getAnswer($question);
    }

    public function population()
    {
        $results = collect();
        $nextPageUrl = 'planets?' . request()->getQueryString();
        do {
            $response = $this->apiClient->get($nextPageUrl);
            $results = $results->merge($response['results']);
            $nextPageUrl = $response['next'];
        } while ($nextPageUrl);

        return $results->pluck('population')
            ->transform(function ($population) {
                return (int)$population;
            })
            ->sum();
    }
}
