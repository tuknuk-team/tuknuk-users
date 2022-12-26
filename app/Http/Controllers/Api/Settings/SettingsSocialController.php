<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsSocialRequest;
use App\Http\Resources\Settings\SettingsSocialResource;
use Illuminate\Support\Facades\DB;

class SettingsSocialController extends Controller
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
                'data' => (new SettingsSocialResource())->data(auth()->user())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?? 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Settings\SettingsSocialResource $resource
     * @param  \App\Http\Requests\Settings\SettingsSocialRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SettingsSocialResource $resource, SettingsSocialRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($resource->update($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Configuração de redes sociais atualizada'
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
