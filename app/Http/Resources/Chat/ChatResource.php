<?php

namespace App\Http\Resources\Chat;

use App\Http\Requests\Chat\CreateNewChatRequest;
use App\Http\Resources\User\UserProfileResource;
use App\Http\Resources\User\UserResource;
use App\Models\Chat\Chat;
use App\Models\User;
use App\Models\User\UserProfile;

class ChatResource
{
    /**
     * @param int $uuid
     *
     * @return \App\Models\Chat\Chat
     */
    public function findByUuid(string $uuid)
    {
        return Chat::where('uuid', $uuid)->first();
    }

    /**
     * @param  \App\Models\User $user
     *
     * @return \App\Models\Chat\Chat
     */
    public function getChats(User $user)
    {
        return Chat::where('is_private', 1)
            ->hasParticipant($user->id)
            ->whereHas('messages')
            ->with('lastMessage.user', 'participants.user.profile', 'participants.user.profile')
            ->latest('updated_at')
            ->get();
    }

    /**
     * @param  string $chat_uuid
     * @param  \App\Models\User $user
     *
     * @return \App\Models\Chat\Chat
     * @throws \Exception
     */
    public function getChat(string $chat_uuid, User $user)
    {
        $chat = $this->findByUuid($chat_uuid);
        if(!$chat){
            throw new \Exception('Conversa não encontrada.', 403);
        }

        return $this->chatArray($chat);
    }

    /**
     * @param  \App\Http\Requests\Chat\CreateNewChatRequest $request
     *
     * @return \App\Models\Chat\Chat
     * @throws \Exception
     */
    public function create(CreateNewChatRequest $request)
    {
        $validated = $request->validated();

        $otherUser = (new UserResource())->findByUsername($validated['username']);
        if(!$otherUser){
            throw new \Exception('Usuário não encontrado.', 403);
        }

        if($otherUser->id === $request->user()->id){
            throw new \Exception('Você não pode abrir uma conversa com você mesmo.', 403);
        }

        $previousChat = $this->getPreviousChat($request->user()->id, $otherUser->id);
        if($previousChat){
            return $this->chatArray($previousChat);
        }
        $chat = Chat::create([
            'created_by' => $request->user()->id
        ]);

        $chat->participants()->createMany([
            [
                'user_id' => $request->user()->id,
            ],
            [
                'user_id' => $otherUser->id
            ]
        ]);

        $chat->refresh()->load('lastMessage.user', 'participants.user');

        return $this->chatArray($chat);
    }

    /**
     * @param  int $user_id
     * @param  int $other_user_id
     *
     * @return \App\Models\Chat\Chat
     */
    public function getPreviousChat(int $user_id, int $other_user_id)
    {
        return Chat::where('is_private', 1)
            ->whereHas('participants', function ($query) use($user_id){
                $query->where('user_id', $user_id);
            })
            ->whereHas('participants', function ($query) use($other_user_id){
                $query->where('user_id', $other_user_id);
            })
            ->first();
    }

    /**
     * @param  \App\Models\Chat\Chat $chat
     * @return array
     */
    public function chatArray(Chat $chat)
    {
        $participants = [];
        foreach($chat->participants()->get() as $participant){
            $participants[] = (new UserProfileResource())->profileDetail($participant->user);
        }

        return [
            'id' => $chat->id,
            'uuid' => $chat->uuid,
            'created_by' => $chat->creator->username,
            'participants' => $participants,
            'last_message' => $chat->lastMessage()
        ];
    }
}
