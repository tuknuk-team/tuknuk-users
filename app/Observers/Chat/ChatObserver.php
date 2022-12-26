<?php

namespace App\Observers\Chat;

use App\Helpers\UuidHelper;
use App\Models\Chat\Chat;

class ChatObserver
{
    /**
     * Handle the Chat "creating" event.
     *
     * @param  \App\Models\Chat\Chat  $chat
     * @return void
     */
    public function creating(Chat $chat)
    {
        $chat->uuid = UuidHelper::generate($chat);
    }

    /**
     * Handle the Chat "created" event.
     *
     * @param  \App\Models\Chat\Chat  $chat
     * @return void
     */
    public function created(Chat $chat)
    {
        //
    }

    /**
     * Handle the Chat "updated" event.
     *
     * @param  \App\Models\Chat\Chat  $chat
     * @return void
     */
    public function updated(Chat $chat)
    {
        //
    }

    /**
     * Handle the Chat "deleted" event.
     *
     * @param  \App\Models\Chat\Chat  $chat
     * @return void
     */
    public function deleted(Chat $chat)
    {
        //
    }

    /**
     * Handle the Chat "restored" event.
     *
     * @param  \App\Models\Chat\Chat  $chat
     * @return void
     */
    public function restored(Chat $chat)
    {
        //
    }

    /**
     * Handle the Chat "force deleted" event.
     *
     * @param  \App\Models\Chat\Chat  $chat
     * @return void
     */
    public function forceDeleted(Chat $chat)
    {
        //
    }
}
