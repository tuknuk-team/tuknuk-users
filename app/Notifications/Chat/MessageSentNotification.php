<?php

namespace App\Notifications\Chat;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class MessageSentNotification extends Notification
{
    use Queueable;

    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    /**
     * Get the OneSignal representation of the notification.
     *
     * @return \NotificationChannels\OneSignal\OneSignalMessage
     */
    public function toOneSignal()
    {
        $messageData = $this->data['messageData'];

        return OneSignalMessage::create()
            ->setSubject($messageData['senderName']. " enviou uma mensagem para você.")
            ->setData('data', $messageData);
    }
}
