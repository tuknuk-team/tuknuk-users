<?php

namespace App\Events\Publication;

use App\Models\Publication\PublicationComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PublicationCommentedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $publicationComment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PublicationComment $publicationComment)
    {
        $this->publicationComment = $publicationComment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('publication-comment');
    }
}
