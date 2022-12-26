<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Resources\Auth\ForgotPasswordResource;

class ForgotPasswordController extends Controller
{
    /**
     * @param \App\Http\Resources\Auth\ForgotPasswordResource $resource
     * @param \App\Http\Requests\Auth\ForgotPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recoverPassword(ForgotPasswordResource $resource, ForgotPasswordRequest $request)
    {
        try {
            return response()->json([
                'status'  => true,
                'message' => $resource->recoverPassword($request)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }
}
