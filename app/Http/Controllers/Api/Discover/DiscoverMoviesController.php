<?php

namespace App\Http\Controllers\Api\Discover;

use App\Http\Controllers\Controller;
use App\Http\Resources\Discover\DiscoverMoviesResource;
use Illuminate\Http\Request;

class DiscoverMoviesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @param  Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function top(Request $request)
    {
        try {
            $page_size = $request->page_size ?: 10;
            $page = $request->page ?: 1;

            return response()->json([
                'status'  => true,
                'movies' => (new DiscoverMoviesResource())->topList($page_size, $page)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
