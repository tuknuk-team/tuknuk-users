<?php

namespace App\Observers\Publication;

use App\Helpers\UuidHelper;
use App\Models\Publication\Publication;

class PublicationObserver
{
    /**
     * Handle the Publication "creating" event.
     *
     * @param  \App\Models\Publication  $publication
     * @return void
     */
    public function creating(Publication $publication)
    {
        $publication->uuid = UuidHelper::generate($publication);
    }

    /**
     * Handle the Publication "created" event.
     *
     * @param  \App\Models\Publication  $publication
     * @return void
     */
    public function created(Publication $publication)
    {
        $publication->statistics()->create();
    }

    /**
     * Handle the Publication "updated" event.
     *
     * @param  \App\Models\Publication  $publication
     * @return void
     */
    public function updated(Publication $publication)
    {
        //
    }

    /**
     * Handle the Publication "deleted" event.
     *
     * @param  \App\Models\Publication  $publication
     * @return void
     */
    public function deleted(Publication $publication)
    {
        $publication->statistics->delete();
    }
}
