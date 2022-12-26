<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsNotificationsRequest;
use App\Http\Resources\Settings\SettingsNotificationsResource;
use Illuminate\Support\Facades\DB;

class SettingsNotificationsController extends Controller
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
                'data' => (new SettingsNotificationsResource())->data(auth()->user())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Settings\SettingsNotificationsResource $resource
     * @param  \App\Http\Requests\Settings\SettingsNotificationsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SettingsNotificationsResource $resource, SettingsNotificationsRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($resource->update($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Configuração de notificações atualizada'
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
