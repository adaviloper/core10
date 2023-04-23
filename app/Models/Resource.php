<?php

namespace App\Models;

use App\Clients\ApiClient;
use App\Clients\SWClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    public const CLASS_MAP = [
        'people' => Person::class,
        'starships' => Starship::class,
        'films' => Film::class,
        'species' => Specie::class,
        'planets' => Planet::class,
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
}
