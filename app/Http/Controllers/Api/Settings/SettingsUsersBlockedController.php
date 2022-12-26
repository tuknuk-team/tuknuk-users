<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Resources\Settings\SettingsUsersBlockedResource;

class SettingsUsersBlockedController extends Controller
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
     * Get Profile Data
     *
     * @param  string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        try {
            return response()->json([
                'status'  => true,
                'data' => (new SettingsUsersBlockedResource())->data(auth()->user())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
