<?php

namespace App\ExternalApis;

use Illuminate\Support\Facades\Http;

class JustWatchApi
{
    /**
     * Create a new ExternalApis instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->api_url = 'https://apis.justwatch.com/content';
        $this->locale = 'pt_BR';
        $this->region = 'pt';
        $this->country = 'bra';
    }

    /**
     * @param  string|null $query
     * @param  int $page_size
     * @param  int $page
     * @param  array $content_types
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function search($query="", $page_size = 10, $page = 1, array $content_types = [])
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->post($this->api_url."/titles/{$this->locale}/popular", [
            'query' => $query,
            'page_size' => $page_size,
            'page' => $page,
            'content_types' => $content_types
        ]);

        return $response->json();
    }

    /**
     * @param  int $id
     * @param  string $object_type
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function title(int $id, string $object_type)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->get($this->api_url."/titles/{$object_type}/{$id}/locale/{$this->region}?country={$this->country}");

        return $response->json();
    }
}
