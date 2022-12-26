<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\CreateMessageRequest;
use App\Http\Resources\Chat\ChatMessageResource;
use App\Http\Resources\Chat\ChatResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatMessageController extends Controller
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
     * @param  Illuminate\Http\Request $request
     * @param  string $chat_uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, string $chat_uuid)
    {
        try {
            $page_size = $request->page_size ?: 10;
            $page = $request->page ?: 1;

            return response()->json([
                'status'  => true,
                'chat' => (new ChatMessageResource())->getMessages($chat_uuid, auth()->user(), $page_size, $page)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Chat\ChatMessageResource $resource
     * @param  \App\Http\Requests\Chat\CreateMessageRequest $request
     * @param  string $chat_uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(ChatMessageResource $resource, CreateMessageRequest $request, string $chat_uuid)
    {
        try {
            DB::beginTransaction();

            if ($message = $resource->create($chat_uuid, $request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Mensagem enviada',
                    'chat_message' => $message
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
