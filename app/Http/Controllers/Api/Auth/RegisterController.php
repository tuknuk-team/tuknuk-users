<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserOnboardingResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($user = (new UserResource())->register($request)) {
                DB::commit();

                $apiName = ($request->header('device-type')) ? $request->header('device-type') : 'web';
                return response()->json([
                    'status'  => true,
                    'message' => __('Cadastro realizado com sucesso'),
                    'token' => $user->createToken($apiName)->plainTextToken,
                    'onboarding' => [
                        'step' => (new UserOnboardingResource())->getActualStep($user)
                    ]
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message'  => $e->getMessage()
            ], 400);
        }
    }
}
