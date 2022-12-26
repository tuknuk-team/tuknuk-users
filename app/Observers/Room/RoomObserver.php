<?php

namespace App\Observers\Room;

use App\Helpers\UuidHelper;
use App\Models\Room\Room;

class RoomObserver
{
    /**
     * Handle the Room "creating" event.
     *
     * @param  \App\Models\Room\Room  $room
     * @return void
     */
    public function creating(Room $room)
    {
        $room->uuid = UuidHelper::generate($room);
    }

    /**
     * Handle the Room "created" event.
     *
     * @param  \App\Models\Room\Room  $room
     * @return void
     */
    public function created(Room $room)
    {
        $room->users()->create([
            'user_id' => $room->user_id,
            'type' => 'owner'
        ]);
    }

    /**
     * Handle the Room "updated" event.
     *
     * @param  \App\Models\Room\Room  $room
     * @return void
     */
    public function updated(Room $room)
    {
        //
    }

    /**
     * Handle the Room "deleted" event.
     *
     * @param  \App\Models\Room\Room  $room
     * @return void
     */
    public function deleted(Room $room)
    {
        //
    }

    /**
     * Handle the Room "restored" event.
     *
     * @param  \App\Models\Room\Room  $room
     * @return void
     */
    public function restored(Room $room)
    {
        //
    }

    /**
     * Handle the Room "force deleted" event.
     *
     * @param  \App\Models\Room\Room  $room
     * @return void
     */
    public function forceDeleted(Room $room)
    {
        //
    }
}
