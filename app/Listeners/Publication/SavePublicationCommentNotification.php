<?php

namespace App\Listeners\Publication;

use App\Events\Publication\PublicationCommentedEvent;
use App\Notifications\Publication\PublicationCommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SavePublicationCommentNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Publication\PublicationCommentedEvent  $event
     * @return void
     */
    public function handle(PublicationCommentedEvent $event)
    {
        return Notification::send($event->publicationComment->publication->user, new PublicationCommentNotification($event->publicationComment));
    }
}
