<?php


namespace app\Helpers;



use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class PaginateHelper
{

    public static function paginate($items, $prevPage)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = collect($items);

        $result = $items->slice(($currentPage - 1) * $prevPage, $prevPage)->all();

        return  new LengthAwarePaginator($result, count($items), $prevPage);

    }
}