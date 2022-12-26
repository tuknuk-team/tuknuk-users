<?php

namespace App\Http\Controllers\Api\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomCreateRequest;
use App\Http\Resources\Room\RoomCategoryResource;
use App\Http\Resources\Room\RoomResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomCreateController extends Controller
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
     * @param  \App\Http\Resources\Room\RoomResource $resource
     * @param  \App\Http\Requests\Room\RoomCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(RoomResource $resource, RoomCreateRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($room = $resource->create($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Sala criada com sucesso',
                    'room' => (new RoomResource())->roomArray($room)
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
