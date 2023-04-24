<?php

namespace App\Models;

use App\Clients\ApiClient;
use App\Clients\SWClient;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resource extends Model
{
    use HasFactory;

    public const PEOPLE_TYPE = 'people';
    public const STARSHIPS_TYPE = 'starships';
    public const FILMS_TYPE = 'films';
    public const SPECIES_TYPE = 'species';
    public const PLANETS_TYPE = 'planets';

    public const TYPES = [
        self::PEOPLE_TYPE,
        self::STARSHIPS_TYPE,
        self::FILMS_TYPE,
        self::SPECIES_TYPE,
        self::PLANETS_TYPE,
    ];

    public const CLASS_MAP = [
        self::PEOPLE_TYPE => Person::class,
        self::STARSHIPS_TYPE => Starship::class,
        self::FILMS_TYPE => Film::class,
        self::SPECIES_TYPE => Specie::class,
        self::PLANETS_TYPE => Planet::class,
    ];

    /**
     * @param $value
     * @param $field
     *
     * @return self
     */
    public function resolveRouteBinding($value, $field = null): self
    {
        $resourceType = request()->route()->parameter('resourceType');
        $resourceClass = static::getResourceClass($resourceType);

        $resourceData = app()->get(ApiClient::class)
            ->get("{$resourceType}/{$value}");

        return new $resourceClass($resourceData);
    }

    public static function getResourceClass(string $resourceType): string
    {
        return self::CLASS_MAP[$resourceType] ?? abort(404);
    }

    public function getAnswer(string $question) {
        throw new Exception('[getAnswer] must be defined.');
    }
}
