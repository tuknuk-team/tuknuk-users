<?php

namespace App\Events\Publication;

use App\Models\Publication\PublicationLike;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PublicationLikedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $publicationLike;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PublicationLike $publicationLike)
    {
        $this->publicationLike = $publicationLike;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('publication-like');
    }
}
