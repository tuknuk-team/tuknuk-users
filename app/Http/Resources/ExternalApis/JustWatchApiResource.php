<?php

namespace App\Http\Resources\ExternalApis;

use App\ExternalApis\JustWatchApi;

class JustWatchApiResource
{
    /**
     * @param  string|null $query
     * @param  string $page_size
     * @param  string $page
     * @param  array $content_types
     *
     * @return array
     */
    public function search(string $query = "", int $page_size = 10,int $page = 1, array $content_types = [])
    {
        return (new JustWatchApi())->search($query, $page_size, $page, $content_types);
    }

    /**
     * @param  int $id
     * @param  string $object_type
     *
     * @return array
     */
    public function title(int $id, string $object_type)
    {
        return (new JustWatchApi())->title($id, $object_type);
    }
}
