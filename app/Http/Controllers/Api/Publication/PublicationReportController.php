<?php

namespace App\Http\Controllers\Api\Publication;

use App\Http\Controllers\Controller;
use App\Http\Resources\Publication\PublicationReportResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicationReportController extends Controller
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
     * @param  \App\Http\Resources\Publication\PublicationReportResource $resource
     * @param  string $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function report(PublicationReportResource $resource, string $uuid)
    {
        try {
            DB::beginTransaction();

            if ($resource->report(auth()->user(), $uuid)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Publicação denunciada',
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
