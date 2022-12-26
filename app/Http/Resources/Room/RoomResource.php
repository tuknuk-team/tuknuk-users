<?php

namespace App\Http\Resources\Room;

use App\Helpers\FileUploadHelper;
use App\Http\Requests\Room\RoomCreateRequest;
use App\Http\Requests\Room\RoomParticipateRequest;
use App\Http\Resources\User\UserProfileResource;
use App\Models\Room\Room;
use App\Models\User;

class RoomResource
{
    /**
     * @param  string $uuid
     *
     * @return \App\Models\Room\Room
     */
    public function findByUuid(string $uuid)
    {
        return Room::where('uuid', $uuid)->first();
    }

    /**
     * @param  \App\Http\Requests\Room\RoomCreateRequest $request
     *
     * @return \App\Models\Room\Room
     * @throws \Exception
     */
    public function create(RoomCreateRequest $request)
    {
        $validated = $request->validated();

        # Avatar
        if ($validated['avatar']) {
            $avatar_url = (new FileUploadHelper())->storeFile($validated['avatar'], 'rooms/avatars');
            if(!$avatar_url){
                throw new \Exception('Ocorreu um erro no upload do avatar.', 403);
            }
        }

        # Cover
        if ($validated['cover']) {
            $cover_url = (new FileUploadHelper())->storeFile($validated['cover'], 'rooms/covers');
            if(!$cover_url){
                throw new \Exception('Ocorreu um erro no upload do cover.', 403);
            }
        }

        if($validated['launch_at']){
            $status = (new RoomStatusResource())->findByCode('pending');
        }else{
            $status = (new RoomStatusResource())->findByCode('active');
        }

        return Room::create([
            'user_id' => $request->user()->id,
            'status_id' => $status->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'avatar_url' => $avatar_url,
            'cover_url' => $cover_url,
            'max_users' => $validated['max_users'],
            'price' => $validated['price'],
            'launch_at' => $validated['launch_at']
        ]);
    }

    /**
     * @param  \App\Models\Room\Room $room
     *
     * @return array
     */
    public function roomArray(Room $room)
    {
        return [
            'id' => $room->uuid,
            'title' => $room->title,
            'description' => $room->description,
            'avatar_url' => $room->avatar_url,
            'cover_url' => $room->cover_url,
            'launch_at' => $room->launch_at,
            'status' => $room->status,
            'max_users' => $room->max_users,
            'actual_users' => $room->users->count(),
            'publications' => $room->publications->count(),
            'created_at' => $room->created_at,
            'user' => (new UserProfileResource())->profileDetail($room->user)
        ];
    }

    /**
     * @param  \App\Models\User $user
     *
     * @param  string $type
     * @return array
     */
    public function roomsList(User $user, string $type)
    {
        $method = "roomList".str_replace('_', '', ucwords($type, '_'));
        return $this->{$method}($user);
    }

    /**
     * @param  \App\Models\User $user
     *
     * @return array
     */
    public function roomListFromUser(User $user)
    {
        $array = [];
        $rooms = Room::where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach($rooms as $room){
            $array[] = $this->roomArray($room);
        }

        return [
            'count' => $rooms->count(),
            'rooms' => $array
        ];
    }

    /**
     * @param  \App\Models\User $user
     *
     * @return array
     */
    public function roomListParticipating(User $user)
    {
        $array = [];
        $rooms = Room::join('users_room', 'rooms.id', '=', 'users_room.room_id')
            ->where('users_room.user_id', $user->id)
            ->orderBy('rooms.created_at', 'DESC')
            ->select('rooms.*')
            ->get();

        foreach($rooms as $room){
            $array[] = $this->roomArray($room);
        }

        return [
            'count' => $rooms->count(),
            'rooms' => $array
        ];
    }

    /**
     * @param  \App\Models\User $user
     *
     * @return array
     */
    public function roomListFeatured(User $user)
    {
        $array = [];
        $rooms = Room::where('featured', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach($rooms as $room){
            $array[] = $this->roomArray($room);
        }

        return [
            'count' => $rooms->count(),
            'rooms' => $array
        ];
    }

    /**
     * @param  \App\Models\User $user
     *
     * @return array
     */
    public function roomListLaunches(User $user)
    {
        $array = [];
        $rooms = Room::where('launch_at', '>', now()->format('Y-m-d H:i:s'))
            ->orderBy('created_at', 'DESC')
            ->get();

        foreach($rooms as $room){
            $array[] = $this->roomArray($room);
        }

        return [
            'count' => $rooms->count(),
            'rooms' => $array
        ];
    }

    /**
     * @param  \App\Http\Requests\Room\RoomParticipateRequest $request
     *
     * @return \App\Models\Room\Room
     * @throws \Exception
     */
    public function participate(RoomParticipateRequest $request)
    {
        $validated = $request->validated();

        $room = $this->findByUuid($validated['room_uuid']);
        if(!$room){
            throw new \Exception('A sala selecionada é inválida.', 403);
        }

        if($request->user()->rooms()->where('room_id', $room->id)->first()){
            throw new \Exception('Você já esta participando desta sala.', 403);
        }

        if($room->status->code != 'active'){
            throw new \Exception('Não é possível participar desta sala neste momento.', 403);
        }

        if($room->launch_at && now()->format('Y-m-d H:i:s') < $room->launch_at){
            throw new \Exception('O lançamento da sala ainda não ocorreu.', 403);
        }

        $type = ($room->price && $room->price > 0) ? 'paid' : 'free';

        $payment_hash = null;
        if($type == 'paid'){
            // to do - debit from wallet
            throw new \Exception('Você não tem saldo suficiente para entrar nesta sala.', 403);
        }

        return $request->user()->rooms()->create([
            'room_id' => $room->id,
            'type' => $type,
            'payment_hash' => $payment_hash,
        ]);
    }
}
