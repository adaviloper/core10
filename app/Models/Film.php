<?php

namespace App\Models;

use App\Clients\ApiClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Resource
{
    use HasFactory;

    protected $guarded = [];

    public function getAnswer(string $question)
    {
        return match($question) {
            'species' => $this->getSpecies(),
        };
    }

    public function getSpecies()
    {
        return collect($this->species)
            ->map(function (string $speciesPath) {
                return app()->get(ApiClient::class)->get($speciesPath);
            })
            ->pluck('classification')
            ->unique()
            ->values();
    }
}
