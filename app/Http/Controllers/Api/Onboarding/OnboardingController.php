<?php

namespace App\Http\Controllers\Api\Onboarding;

use App\Http\Controllers\Controller;
use App\Http\Resources\Onboarding\OnboardingResource;
use App\Http\Resources\User\UserOnboardingResource;

class OnboardingController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllSteps()
    {
        return response()->json([
            'status'  => true,
            'steps' => (new OnboardingResource())->getAllSteps()->toArray()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActualStep()
    {
        return response()->json([
            'status'  => true,
            'step' => (new UserOnboardingResource())->getActualStep(auth()->user())
        ]);
    }
}
