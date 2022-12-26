<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchUsernameRequest;
use App\Http\Resources\Search\SearchResource;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param  \App\Http\Resources\Search\SearchResource $resource
     * @param  \App\Http\Requests\Search\SearchUsernameRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchUsername(SearchResource $resource, SearchUsernameRequest $request)
    {
        try {
            if ($results = $resource->searchUsername($request)) {

                return response()->json([
                    'status'  => true,
                    'message' => 'Usuário(s) encontrado(s)',
                    'count' => count($results),
                    'results' => $results
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
