<?php

namespace App\Providers;

use App\Events\Publication\PublicationCommentedEvent;
use App\Events\Publication\PublicationLikedEvent;
use App\Listeners\Publication\SavePublicationCommentNotification;
use App\Listeners\Publication\SavePublicationLikeNotification;
use App\Models\Chat\Chat;
use App\Models\Publication\Publication;
use App\Models\Publication\PublicationComment;
use App\Models\Publication\PublicationCommentLike;
use App\Models\Publication\PublicationLike;
use App\Models\Publication\PublicationReport;
use App\Models\Room\Room;
use App\Models\User;
use App\Observers\Chat\ChatObserver;
use App\Observers\Publication\PublicationCommentLikeObserver;
use App\Observers\Publication\PublicationCommentObserver;
use App\Observers\Publication\PublicationLikeObserver;
use App\Observers\Publication\PublicationObserver;
use App\Observers\Publication\PublicationReportObserver;
use App\Observers\Room\RoomObserver;
use App\Observers\User\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PublicationLikedEvent::class => [
            SavePublicationLikeNotification::class,
        ],
        PublicationCommentedEvent::class => [
            SavePublicationCommentNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        # User
        User::observe(UserObserver::class);

        # Publication
        Publication::observe(PublicationObserver::class);
        PublicationLike::observe(PublicationLikeObserver::class);
        PublicationReport::observe(PublicationReportObserver::class);
        PublicationComment::observe(PublicationCommentObserver::class);
        PublicationCommentLike::observe(PublicationCommentLikeObserver::class);

        # Room
        Room::observe(RoomObserver::class);

        # Chat
        Chat::observe(ChatObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
