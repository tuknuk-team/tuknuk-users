<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\CreateNewChatRequest;
use App\Http\Resources\Chat\ChatResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
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
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function chats(Request $request)
    {
        try {
            return response()->json([
                'status'  => true,
                'chats' => (new ChatResource())->getChats(auth()->user())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  string $chat_uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $chat_uuid)
    {
        try {
            return response()->json([
                'status'  => true,
                'chats' => (new ChatResource())->getChat($chat_uuid, auth()->user())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * @param  \App\Http\Resources\Chat\ChatResource $resource
     * @param  \App\Http\Requests\Chat\CreateNewChatRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(ChatResource $resource, CreateNewChatRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($chat = $resource->create($request)) {
                DB::commit();

                return response()->json([
                    'status'  => true,
                    'message' => 'Chat criado',
                    'chat' => $chat
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
