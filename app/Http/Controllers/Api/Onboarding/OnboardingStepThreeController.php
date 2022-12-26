<?php

namespace App\Http\Controllers\Api\Onboarding;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserInterestResource;
use App\Http\Resources\User\UserOnboardingResource;

class OnboardingStepThreeController extends Controller
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
    public function getSuggestions()
    {
        return response()->json([
            'status'  => true,
            'suggestions' => (new UserInterestResource())->getUserSuggestions(auth()->user()),
            'onboarding' => [
                'step' => (new UserOnboardingResource())->getActualStep(auth()->user())
            ]
        ]);
    }
}
