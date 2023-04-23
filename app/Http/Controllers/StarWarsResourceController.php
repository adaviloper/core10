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
    )
    {
        $this->middleware(function (Request $request, \Closure $next) {
            throw_if(!in_array(request()->route()->parameter('resourceType'), [
                'people',
                'starships',
                'films',
            ]), NotFoundHttpException::class);
            return $next($request);
        })->only(['index', 'find']);
    }

    public function index(string $resourceType)
    {
        return $this->apiClient
            ->get("$resourceType")
        ;
    }

    public function find(Request $request, string $resourceType, Resource $resource)
    {
        return $resource;
    }

    public function starships(string $resourceType, Resource $resource)
    {
        return collect($resource->starships)->map(function (string $starshipPath) {
            return $this->apiClient->get($starshipPath);
        });
    }

    public function species(string $resourceType, Resource $resource)
    {
        return collect($resource->species)
            ->map(function (string $speciesPath) {
                return $this->apiClient->get($speciesPath);
            })
            ->pluck('classification')
            ->unique()
            ->values()
        ;
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
            ->sum()
        ;
    }
}
