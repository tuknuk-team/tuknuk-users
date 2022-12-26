<?php

namespace App\Http\Controllers\Api\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomParticipateRequest;
use App\Http\Resources\Room\RoomResource;
use App\Http\Resources\User\UserProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
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
     * @param  string $room_uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(string $room_uuid)
    {
        try {
            $room = (new RoomResource())->findByUuid($room_uuid);
            if (!$room) {
                throw new \Exception('Sala não encontrada.', 404);
            }

            return response()->json([
                'status'  => true,
                'room' => (new RoomResource())->roomArray($room)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  string $room_uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function participateStart(string $room_uuid)
    {
        try {
            $room = (new RoomResource())->findByUuid($room_uuid);
            if (!$room) {
                throw new \Exception('Sala não encontrada.', 404);
            }

            return response()->json([
                'status'  => true,
                'room' => (new RoomResource())->roomArray($room),
                'user' => (new UserProfileResource())->profileDetail(auth()->user())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Room\RoomResource $resource
     * @param  \App\Http\Requests\Room\RoomParticipateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function participateFinish(RoomResource $resource, RoomParticipateRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($resource->participate($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Você começou a participar da sala'
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
