<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserProfileResource;

class AccountController extends Controller
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
     * Get User Data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userData()
    {
        return response()->json([
            'status' => true,
            'data' => (new UserProfileResource())->profileDetail(auth()->user()),
        ], 200);
    }
}
