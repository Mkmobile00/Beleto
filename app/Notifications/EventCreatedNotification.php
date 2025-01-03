<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\FcmMessage;

class EventCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData([
                'event_id' => $this->event->event_id,
                'title' => 'Event Created',
                'body' => 'A new event has been created.',
            ]);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
