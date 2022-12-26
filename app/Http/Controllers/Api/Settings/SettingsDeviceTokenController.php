<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsDeviceTokenUpdateRequest;
use App\Http\Resources\Settings\SettingsUserDeviceTokenResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsDeviceTokenController extends Controller
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
     * @param  \App\Http\Resources\Settings\SettingsUserDeviceTokenResource $resource
     * @param  \App\Http\Requests\Settings\SettingsDeviceTokenUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDeviceToken(SettingsUserDeviceTokenResource $resource, SettingsDeviceTokenUpdateRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($resource->update($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Token atualizado com sucesso'
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
