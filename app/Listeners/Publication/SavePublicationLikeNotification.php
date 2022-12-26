<?php

namespace App\Listeners\Publication;

use App\Events\Publication\PublicationLikedEvent;
use App\Models\Publication\PublicationLike;
use App\Notifications\Publication\PublicationLikeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SavePublicationLikeNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Publication\PublicationLikedEvent  $event
     * @return void
     */
    public function handle(PublicationLikedEvent $event)
    {
        return Notification::send($event->publicationLike->publication->user, new PublicationLikeNotification($event->publicationLike));
    }
}
