<?php

namespace App\Models;

use App\Clients\ApiClient;
use App\Clients\SWClient;
use Database\Factories\PersonFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * @method static PersonFactory factory()
 * @property string $resourcePath
 */
class Person extends Resource
{
    use HasFactory;

    protected string $resourceType = 'people';

    protected $guarded = [];

    protected $with = [
        'starships',
    ];

    protected function resourcePath(): Attribute
    {
        return Attribute::make(
            get: fn () => "swapi.dev/{$this->resourceType}/{$this->id}",
        );
    }
}
