<?php

namespace App\Paginator;

use Illuminate\Support\Collection;

class ResourcePaginator
{
    /**
     * @var int|mixed
     */
    private mixed $page;

    private int $count;

    /**
     * @var int|mixed
     */
    private mixed $perPage;

    public function __construct(
        protected Collection $data,
        protected array $options = [
            'page' => 1,
            'perPage' => 15,
        ]
    )
    {
        $this->count = $this->data->count();
        $this->page = $options['page'] ?? 1;
        $this->perPage = $options['perPage'] ?? 2;
        $this->type = $this->options['type'];
    }

    public function getPaginationSet(): array
    {
        return [
            'count' => $this->count,
            'page' => $this->page,
            'next' => $this->getNextPageUrl(),
            'previous' => $this->getPreviousPageUrl(),
            'results' => $this->getDataForCurrentPage()
        ];
    }

    protected function getDataForCurrentPage(): array
    {
        if ($this->perPage > $this->count) {
            return $this->data->toArray();
        }
        return $this->data
            ->chunk($this->perPage)
            ->get($this->page - 1)
            ->values()
            ->toArray()
            ;
    }

    private function getNextPageUrl()
    {
        $totalPages = ceil($this->count / $this->perPage);
        if ($this->page >= $totalPages) {
            return null;
        }

        return $this->type.'?page='.($this->page + 1);
    }

    private function getPreviousPageUrl()
    {
        if ($this->page === 1) {
            return null;
        }

        return $this->type.'?page='.($this->page - 1);
    }
}
