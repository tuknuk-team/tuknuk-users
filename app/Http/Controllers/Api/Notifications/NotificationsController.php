<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notifications\NotificationsResource;
use Illuminate\Http\Request;

class NotificationsController extends Controller
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
     * Get Notifications
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        try {
            $limit = ($request->limit) ? $request->limit : 10;
            $page = ($request->page) ? $request->page : 1;

            $notifications = (new NotificationsResource())->list($request, $limit, $page);
            $notifications->withPath(route('api.notifications'));

            return response()->json([
                'status'  => true,
                'notifications' => $notifications
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
