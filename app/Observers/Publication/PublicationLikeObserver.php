<?php

namespace App\Observers\Publication;

use App\Events\Publication\PublicationLikedEvent;
use App\Models\Publication\PublicationLike;
use App\Notifications\Publication\PublicationLikeNotification;

class PublicationLikeObserver
{
    /**
     * Handle the PublicationLike "created" event.
     *
     * @param  \App\Models\Publication\PublicationLike  $publicationLike
     * @return void
     */
    public function created(PublicationLike $publicationLike)
    {
        $publicationLike->publication->statistics->update([
            'likes' =>  $publicationLike->publication->statistics->likes + 1,
        ]);

        event(new PublicationLikedEvent($publicationLike));
    }

    /**
     * Handle the PublicationLike "deleted" event.
     *
     * @param  \App\Models\Publication\PublicationLike  $publicationLike
     * @return void
     */
    public function deleted(PublicationLike $publicationLike)
    {
        $publicationLike->publication->statistics->update([
            'likes' =>  $publicationLike->publication->statistics->likes - 1,
        ]);
    }
}
