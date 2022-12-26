<?php

namespace App\Observers\Publication;

use App\Models\Publication\PublicationReport;
use App\Notifications\Publication\PublicationLikeNotification;

class PublicationReportObserver
{

    /**
     * Handle the PublicationReport "created" event.
     *
     * @param  \App\Models\Publication\PublicationReport $publicationReport
     * @return void
     */
    public function created(PublicationReport$publicationReport)
    {
        $publicationReport->publication->statistics->update([
            'reports' =>  $publicationReport->publication->statistics->reports + 1,
        ]);
    }

    /**
     * Handle the PublicationReport" deleted" event.
     *
     * @param  \App\Models\Publication\PublicationReport $publicationReport
     * @return void
     */
    public function deleted(PublicationReport$publicationReport)
    {
        $publicationReport->publication->statistics->update([
            'reports' =>  $publicationReport->publication->statistics->reports - 1,
        ]);
    }
}
