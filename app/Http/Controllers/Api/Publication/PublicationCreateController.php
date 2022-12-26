<?php

namespace App\Http\Controllers\Api\Publication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationCreateRequest;
use App\Http\Requests\Publication\PublicationSearchDiscoverRequest;
use App\Http\Resources\Publication\PublicationResource;
use App\Http\Resources\Publication\PublicationTypeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicationCreateController extends Controller
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
     * Get Types of Publication
     *
     * @param  string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function types()
    {
        try {
            return response()->json([
                'status'  => true,
                'data' => (new PublicationTypeResource())->getAll()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Publication\PublicationResource $resource
     * @param  \App\Http\Requests\Publication\PublicationCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(PublicationResource $resource, PublicationCreateRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($publication = $resource->create($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'A sua Publicação foi criada',
                    'publication' => (new PublicationResource())->publicationArray($publication)
                ]);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Publication\PublicationResource $resource
     * @param  \App\Http\Requests\Publication\PublicationSearchDiscoverRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchDiscover(PublicationResource $resource, PublicationSearchDiscoverRequest $request)
    {
        try {
            return response()->json([
                'status'  => true,
                'discover' => $resource->searchDiscover($request)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
