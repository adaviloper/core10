<?php

namespace App\Clients;

use App\Models\Person;
use App\Models\Resource;
use App\Paginator\ResourcePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function PHPUnit\Framework\throwException;

class FakeClient extends ApiClient
{
    public Collection $resources;

    private array $query;

    public function __construct()
    {
        $this->resources = collect();
    }

    public function __call(string $method, array $arguments)
    {
        [$resourceType, $resourceId, $query] = static::parseUrl($arguments[0]);
        $this->query = $query;
        return match ($method) {
            'get' => $this->getResource($resourceType, $resourceId),
            default => throwException(new NotFoundHttpException())
        };
    }

    private function getResource(string $type, ?string $id)
    {
        if ($id !== null) {
            return $this->resources[$type]->first(
                function (Resource $resource) use ($id, $type) {
                    return str_ends_with($resource['url'], "{$type}/$id");
                },
                function () use ($type) {
                    $class = Resource::getResourceClass($type);
                    return new $class();
                })
                ->toArray();
        }

        $this->query['type'] = $type;
        return (new ResourcePaginator($this->resources[$type], $this->query))->getPaginationSet();
    }

    public function addResource($type, $record): void
    {
        if (!isset($this->resources[$type])) {
            $this->resources[$type] = collect();
        }
        $this->resources[$type]->push($record);
    }

    public static function sanitizeUrl($path): string
    {
        return parent::sanitizeUrl($path);
    }
}
