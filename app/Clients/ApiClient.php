<?php

namespace App\Clients;

use Illuminate\Support\Str;

abstract class ApiClient
{
    protected const STAR_WARS_API_PATH = 'https://swapi.dev/api/';

    protected static function sanitizeUrl($path): string
    {
        return Str::replace(self::STAR_WARS_API_PATH, '', $path);
    }

    protected static function parseUrl($path): array
    {
        $urlParts = explode('?', $path);
        $query = [];
        if (isset($urlParts[1])) {
            parse_str($urlParts[1], $query);
        }
        $path = Str::replace(self::STAR_WARS_API_PATH, '', trim($urlParts[0], '/'));

        $path = explode('/', $path);

        return [$path[0], $path[1] ?? null, $query];
    }

    abstract public function __call(string $method, array $arguments);
}
