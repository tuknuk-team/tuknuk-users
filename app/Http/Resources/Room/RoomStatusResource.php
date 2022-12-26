<?php

namespace App\Http\Resources\Room;

use App\Models\Room\RoomStatus;

class RoomStatusResource
{
    /**
     * @param  string $code
     *
     * @return \App\Models\Room\RoomStatus
     */
    public function findByCode(string $code)
    {
        return RoomStatus::where('code', $code)->first();
    }
}
