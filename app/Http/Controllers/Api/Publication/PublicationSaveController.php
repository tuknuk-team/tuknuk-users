<?php

namespace App\Http\Controllers\Api\Publication;

use App\Http\Controllers\Controller;
use App\Http\Resources\Publication\PublicationSaveResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicationSaveController extends Controller
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
     * @param  \App\Http\Resources\Publication\PublicationSaveResource $resource
     * @param  string $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(PublicationSaveResource $resource, string $uuid)
    {
        try {
            DB::beginTransaction();

            if ($resource->save(auth()->user(), $uuid)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Publicação salva',
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
     * @param  \App\Http\Resources\Publication\PublicationSaveResource $resource
     * @param  string $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(PublicationSaveResource $resource, string $uuid)
    {
        try {
            DB::beginTransaction();

            if ($resource->remove(auth()->user(), $uuid)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Publicação removida de salvos',
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
