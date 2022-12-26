<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsSecurity2FaActivateRequest;
use App\Http\Requests\Settings\SettingsSecurity2FaDisableRequest;
use App\Http\Requests\Settings\SettingsSecurityPasswordRequest;
use App\Http\Resources\Settings\SettingsSecurityResource;
use Illuminate\Support\Facades\DB;

class SettingsSecurityController extends Controller
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
     * @param  \App\Http\Resources\Settings\SettingsSecurityResource $resource
     * @param  \App\Http\Requests\Settings\SettingsSecurityPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(SettingsSecurityResource $resource, SettingsSecurityPasswordRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($resource->updatePassword($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Configuração da senha atualizada'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * Get Security 2FA Data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data2fa()
    {
        try {
            return response()->json([
                'status'  => true,
                'data' => (new SettingsSecurityResource())->get2faData(auth()->user())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Settings\SettingsSecurityResource $resource
     * @param  \App\Http\Requests\Settings\SettingsSecurity2FaActivateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function enable2Fa(SettingsSecurityResource $resource, SettingsSecurity2FaActivateRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($resource->activateTwoAuth($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Configuração do 2FA atualizada'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Settings\SettingsSecurityResource $resource
     * @param  \App\Http\Requests\Settings\SettingsSecurity2FaDisableRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function disable2Fa(SettingsSecurityResource $resource, SettingsSecurity2FaDisableRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($resource->disableTwoAuth($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Configuração do 2FA atualizada'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
