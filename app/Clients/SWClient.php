<?php

namespace App\Clients;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SWClient extends ApiClient
{
    public function __call(string $method, array $arguments)
    {
        $arguments[0] = static::sanitizeUrl($arguments[0]);
        return Cache::remember(
            $method.':'.$arguments[0],
            CarbonInterface::SECONDS_PER_MINUTE * CarbonInterface::MINUTES_PER_HOUR * CarbonInterface::HOURS_PER_DAY,
            function() use ($method, $arguments) {
                return Http::baseUrl(self::STAR_WARS_API_PATH)
                    ->$method(...$arguments)
                    ->json();
            }
        );
    }
}
