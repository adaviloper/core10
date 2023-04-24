<?php

namespace App\Models;

use App\Clients\ApiClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Resource
{
    use HasFactory;

    public function getAnswer(string $question)
    {
        return match ($question) {
            'population' => $this->getPopulation()
        };
    }

    public function getPopulation()
    {
        $results = collect();
        $nextPageUrl = 'planets?' . request()->getQueryString();
        do {
            $response = app()->get(ApiClient::class)->get($nextPageUrl);
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
