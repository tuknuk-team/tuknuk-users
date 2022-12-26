<?php

namespace App\Http\Controllers\Api\Room;

use App\Http\Controllers\Controller;
use App\Http\Resources\Room\RoomResource;
use Illuminate\Http\Request;

class RoomListController extends Controller
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
     * @param  string $type
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(string $type)
    {
        try {
            return response()->json([
                'status'  => true,
                'rooms' => (new RoomResource())->roomsList(auth()->user(), $type)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
