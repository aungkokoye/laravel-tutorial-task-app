<?php

namespace App\Jobs;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class EventReminderJob implements ShouldQueue
{
    use Queueable;

    /**
     * @param Collection<int, Event> $events
     */
    public function __construct(private readonly Collection $events)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->events->each(function (Event $event) {
            $event->attendees->each(function ($attendee) use ($event) {
                $user = $attendee->user;
                $user->notify(new EventReminderNotification($event));
            });
        });
    }
}
