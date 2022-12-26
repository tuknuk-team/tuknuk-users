<?php

namespace App\Http\Resources\Discover;

use App\Http\Resources\ExternalApis\JustWatchApiResource;
use Illuminate\Support\Facades\Cache;

class DiscoverSeriesResource
{
    /**
     * @param  int $page_size
     * @param  int $page
     *
     * @return array
     * @throws \Exception
     */
    public function topList(int $page_size = 10, int $page = 1, array $content_types = ['show'])
    {
        return Cache::remember("discoverSeriesTopList_{$page_size}_{$page}", 86400, function () use($page_size, $page, $content_types) {
            $results = (new JustWatchApiResource())->search("", $page_size, $page, $content_types);

            if(!isset($results['items']) || count($results['items']) == 0){
                throw new \Exception('Nenhuma série encontrado.', 404);
            }

            $array = [];
            foreach($results['items'] as $result){
                $array[] = $this->arraySerie($result);
            }

            return [
                'page' => $results['page'],
                'page_size' => $results['page_size'],
                'total_pages' => $results['total_pages'],
                'total_results' => $results['total_results'],
                'items' => $array
            ];

        });
    }

    /**
     * @param  array $result
     * @return array
     */
    public function arraySerie(array $result)
    {
        $getSlug = explode('/', $result['full_path']);
        $getSlug = end($getSlug);

        $getPosterCode = explode('/', $result['poster'])[2];

        $title = (new JustWatchApiResource())->title($result['id'], $result['object_type']);

        return [
            'id' => $result['id'],
            'title' => $result['title'],
            'poster' => "https://images.justwatch.com/poster/{$getPosterCode}/s332/{$getSlug}.webp",
            'type' => $result['object_type'],
            'short_description' => $title['short_description'],
            'original_release_year' => $title['original_release_year'],
            'original_title' => $title['original_title']
        ];
    }

    /**
     * @param  string $query
     * @return array
     */
    public function search(string $query)
    {
        $results = (new JustWatchApiResource())->search($query, 3, 1, ['show']);

        if(!isset($results['items']) || count($results['items']) == 0){
            throw new \Exception('Nenhum filme encontrado.', 404);
        }

        $array = [];
        foreach($results['items'] as $result){
            $array[] = $this->arraySerie($result);
        }

        return [
            'page' => $results['page'],
            'page_size' => $results['page_size'],
            'total_pages' => $results['total_pages'],
            'total_results' => $results['total_results'],
            'items' => $array
        ];
    }
}
