<?php

namespace App\Observers\Publication;

use App\Events\Publication\PublicationLikedEvent;
use App\Models\Publication\PublicationCommentLike;
use App\Models\Publication\PublicationLike;
use App\Notifications\Publication\PublicationLikeNotification;

class PublicationCommentLikeObserver
{
    /**
     * Handle the PublicationCommentLike "created" event.
     *
     * @param  \App\Models\Publication\PublicationCommentLike  $publicationCommentLike
     * @return void
     */
    public function created(PublicationCommentLike $publicationCommentLike)
    {
        $publicationCommentLike->comment->statistics->update([
            'likes' =>  $publicationCommentLike->comment->statistics->likes + 1,
        ]);

        // event(new PublicationLikedEvent($publicationLike));
    }

    /**
     * Handle the PublicationCommentLike "deleted" event.
     *
     * @param  \App\Models\Publication\PublicationCommentLike  $publicationCommentLike
     * @return void
     */
    public function deleted(PublicationCommentLike $publicationCommentLike)
    {
        $publicationCommentLike->comment->statistics->update([
            'likes' =>  $publicationCommentLike->comment->statistics->likes - 1,
        ]);
    }
}
