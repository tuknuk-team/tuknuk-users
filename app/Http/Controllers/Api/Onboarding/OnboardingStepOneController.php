<?php

namespace App\Http\Controllers\Api\Onboarding;

use App\Http\Controllers\Controller;
use App\Http\Requests\Onboarding\StepOneRequest;
use App\Http\Resources\User\UserOnboardingResource;
use Illuminate\Support\Facades\DB;

class OnboardingStepOneController extends Controller
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
     * @param  \App\Http\Resources\User\UserOnboardingResource $resource
     * @param  \App\Http\Requests\Onboarding\StepOneRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStep(UserOnboardingResource $resource, StepOneRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($resource->updateStepOne($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Perfil atualizado com sucesso',
                    'onboarding' => [
                        'step' => (new UserOnboardingResource())->getActualStep($request->user())
                    ]
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }
}
