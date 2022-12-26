<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Resources\Auth\ResetPasswordResource;

class ResetPasswordController extends Controller
{
    /**
     * @param \App\Http\Resources\Auth\ResetPasswordResource $resource
     * @param \App\Http\Requests\Auth\ResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePasswordRecovery(ResetPasswordResource $resource, ResetPasswordRequest $request)
    {
        try {
            return response()->json([
                'status'  => true,
                'message' => $resource->updatePasswordRecovery($request)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }
}
