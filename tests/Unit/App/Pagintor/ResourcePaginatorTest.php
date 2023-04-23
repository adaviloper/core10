<?php

namespace Tests\Unit\App\Pagintor;

use App\Paginator\ResourcePaginator;
use PHPUnit\Framework\TestCase;

class ResourcePaginatorTest extends TestCase
{
    /** @test */
    public function it_can_get_an_offset_of_data()
    {
        $collection = collect([1, 2, 3, 4, 5]);
        $paginator = new ResourcePaginator($collection, [
            'perPage' => 2,
            'page' => 3
        ]);

        $this->assertEquals([5], $paginator->getPaginationSet()['results']);
    }

    /** @test */
    public function it_returns_the_entire_data_set_if_the_amount_per_page_is_greater_than_the_data_length()
    {
        $collection = collect([1, 2, 3, 4, 5]);
        $paginator = new ResourcePaginator($collection, [
            'perPage' => 10,
        ]);

        $this->assertEquals([1,2,3,4,5], $paginator->getPaginationSet()['results']);
    }
}
