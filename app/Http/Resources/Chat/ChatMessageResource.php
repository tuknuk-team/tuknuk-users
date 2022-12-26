<?php

namespace App\Http\Resources\Chat;

use App\Events\Chat\NewMessageSentEvent;
use App\Http\Requests\Chat\CreateMessageRequest;
use App\Http\Resources\User\UserProfileResource;
use App\Models\Chat\Chat;
use App\Models\Chat\ChatMessage;
use App\Models\User;

class ChatMessageResource
{
    /**
     * @param  string $chat_uuid
     * @param  \App\Models\User $user
     * @param  int $page_size
     * @param  int $page
     *
     * @return \App\Models\Chat\Chat
     * @throws \Exception
     */
    public function getMessages(string $chat_uuid, User $user, int $page_size = 10, int $page = 1)
    {
        $chat = (new ChatResource())->findByUuid($chat_uuid);
        if(!$chat){
            throw new \Exception('Conversa não encontrada.', 403);
        }

        $messages = ChatMessage::where('chat_id', $chat->id)
            ->with('user')
            ->latest('created_at')
            ->simplePaginate(
                $page_size,
                ['*'],
                'page',
                $page
            )
            ->getCollection();

        foreach ($messages as $message) {
            $array[] = $this->chatMessageArray($message);
        }

        return $array;
    }

    /**
     * @param  string $chat_uuid
     * @param  \App\Http\Requests\Chat\CreateMessageRequest $request
     *
     * @return \App\Models\Chat\ChatMessage
     * @throws \Exception
     */
    public function create(string $chat_uuid, CreateMessageRequest $request)
    {
        $validated = $request->validated();

        $chat = (new ChatResource())->findByUuid($chat_uuid);
        if(!$chat){
            throw new \Exception('Conversa não encontrada.', 403);
        }

        $chatMessage =  $chat->messages()->create([
            'user_id' => $request->user()->id,
            'message' => $validated['message']
        ]);

        $this->sendNotificationMessageToOther($chatMessage);

        // TODO - send broadcast event to pusher
        // TODO - send notification to onesignal

        return $chatMessage;
    }

    /**
     * @param  \App\Models\Chat\ChatMessage $chatMessage
     * @return array
     */
    public function chatMessageArray(ChatMessage $chatMessage)
    {
        return [
            'chat_uuid' => $chatMessage->chat->uuid,
            'chat_id' => $chatMessage->chat->id,
            'message' => $chatMessage->message,
            'user' => (new UserProfileResource())->profileDetailSimple($chatMessage->user),
        ];
    }

    /**
     * @param  \App\Models\Chat\ChatMessage $chatMessage
     */
    private function sendNotificationMessageToOther(ChatMessage $chatMessage)
    {
        broadcast(new NewMessageSentEvent($chatMessage))->toOthers();

        $user = auth()->user();
        $userId = $user->id;

        $chat = Chat::where('id', $chatMessage->chat_id)
            ->with(['participants' => function($query) use($userId){
                $query->where('user_id', '!=', $userId);
            }])
            ->first();

        if(count($chat->participants) > 0){
            $otherUserId = $chat->participants[0]->user_id;
            $otherUser = User::find($otherUserId);

            $otherUser->sendNewMessageNotification([
                'messageData' => [
                    'senderName' => $user->username,
                    'message' => $chatMessage->message,
                    'chatId' => $chatMessage->chat_id
                ]
            ]);
        }
    }
}
