<?php

namespace App\Notifications\Publication;

use App\Models\Publication\PublicationComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PublicationCommentNotification extends Notification
{
    use Queueable;

    public $publicationComment;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Publication\PublicationComment $publicationLike
     * @return void
     */
    public function __construct(PublicationComment $publicationComment)
    {
        $this->publicationComment = $publicationComment;
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
            'type' => 'publication_comment',
            'publication_comment_id' => $this->publicationComment->id,
            'message' => 'fez um comentário em sua publicação'
        ];
    }
}
