<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsPrivacyRequest;
use App\Http\Resources\Settings\SettingsPrivacyResource;
use Illuminate\Support\Facades\DB;

class SettingsPrivacyController extends Controller
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
                'data' => (new SettingsPrivacyResource())->data(auth()->user())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Settings\SettingsProfileResource $resource
     * @param  \App\Http\Requests\Settings\SettingsProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SettingsPrivacyResource $resource, SettingsPrivacyRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($resource->update($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Configuração de privacidade atualizada'
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
