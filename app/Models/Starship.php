<?php

namespace App\Models;

use App\Clients\ApiClient;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string  resourcePath
 */
class Starship extends Resource
{
    use HasFactory;

    protected string $resourceType = 'starships';

    protected $guarded = [];

    protected function resourcePath(): Attribute
    {
        return Attribute::make(
            get: fn () => "swapi.dev/{$this->resourceType}/{$this->id}",
        );
    }

    public function getAnswer(string $question)
    {
        //
    }
}
