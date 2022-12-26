<?php

namespace App\Observers\Publication;

use App\Events\Publication\PublicationCommentedEvent;
use App\Models\Publication\PublicationComment;
use App\Notifications\Publication\PublicationCommentNotification;

class PublicationCommentObserver
{
    /**
     * Handle the PublicationComment "created" event.
     *
     * @param  \App\Models\Publication\PublicationComment  $publicationComment
     * @return void
     */
    public function created(PublicationComment $publicationComment)
    {
        $publicationComment->statistics()->create();

        $publicationComment->publication->statistics->update([
            'comments' =>  $publicationComment->publication->statistics->comments + 1,
        ]);

        event(new PublicationCommentedEvent($publicationComment));
    }


    /**
     * Handle the PublicationComment "updated" event.
     *
     * @param  \App\Models\Publication\PublicationComment  $publicationComment
     * @return void
     */
    public function updated(PublicationComment $publicationComment)
    {
        //
    }

    /**
     * Handle the PublicationComment "deleted" event.
     *
     * @param  \App\Models\Publication\PublicationComment  $publicationComment
     * @return void
     */
    public function deleted(PublicationComment $publicationComment)
    {
        $publicationComment->publication->statistics->update([
            'comments' =>  $publicationComment->publication->statistics->comments - 1,
        ]);
    }

    /**
     * Handle the PublicationComment "restored" event.
     *
     * @param  \App\Models\Publication\PublicationComment  $publicationComment
     * @return void
     */
    public function restored(PublicationComment $publicationComment)
    {
        //
    }

    /**
     * Handle the PublicationComment "force deleted" event.
     *
     * @param  \App\Models\Publication\PublicationComment  $publicationComment
     * @return void
     */
    public function forceDeleted(PublicationComment $publicationComment)
    {
        //
    }
}
