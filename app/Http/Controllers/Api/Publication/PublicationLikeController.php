<?php

namespace App\Http\Controllers\Api\Publication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationLikeRequest;
use App\Http\Resources\Publication\PublicationLikeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicationLikeController extends Controller
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
     * @param  \App\Http\Resources\Publication\PublicationLikeResource $resource
     * @param  string $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(PublicationLikeResource $resource, string $uuid)
    {
        try {
            DB::beginTransaction();

            if ($resource->like(auth()->user(), $uuid)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Publicação curtida',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Publication\PublicationLikeResource $resource
     * @param  string $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function dislike(PublicationLikeResource $resource, string $uuid)
    {
        try {
            DB::beginTransaction();

            if ($resource->dislike(auth()->user(), $uuid)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Publicação descurtida',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
