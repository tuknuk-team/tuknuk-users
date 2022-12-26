<?php

namespace App\Traits;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

trait PaginationTrait
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 10, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentPage = $page;
        $offset = ($currentPage * $perPage) - $perPage ;
        $itemsToShow = array_slice($items, $offset, $perPage);

        return new LengthAwarePaginator($itemsToShow, $total, $perPage);
    }
}
