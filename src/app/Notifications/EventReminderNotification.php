<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReminderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public readonly Event $event)
    {}

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
            ->subject('Event Reminder Notification')
            ->greeting($this->event->user->name . ',')
            ->line("The event titled '{$this->event->name}' will start in 24 hrs.")
            ->line("The event start at {$this->event->start_time}.")
            ->action('Event Url:', url('/'))
            ->line('Thank you for using our application!')
            ->salutation('Best regards, The MyApp Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'event_id'          => $this->event->id,
            'title'             => $this->event->name,
            'start_time'        => $this->event->start_time,
            'event_owner_id'    => $this->event->user()->id,
            'event_owner_name'  => $this->event->user()->name,
        ];
    }
}
