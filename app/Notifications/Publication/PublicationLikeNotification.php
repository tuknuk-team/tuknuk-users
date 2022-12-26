<?php

namespace App\Notifications\Publication;

use App\Models\Publication\PublicationLike;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PublicationLikeNotification extends Notification
{
    use Queueable;

    public $publicationLike;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Publication\PublicationLike $publicationLike
     * @return void
     */
    public function __construct(PublicationLike $publicationLike)
    {
        $this->publicationLike = $publicationLike;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => 'publication_like',
            'publication_like_id' => $this->publicationLike->id,
            'message' => 'curtiu sua publicação'
        ];
    }
}
