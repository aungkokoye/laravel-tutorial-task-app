<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class EventNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:event-reminder-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for upcoming events to attendees';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::with('attendees.user')
            ->where('start_time', '>=', now())
            ->where('start_time', '<=', now()->addDay())
            ->get();

        $eventCount = $events->count();
        $eventLabel = Str::plural('event', $eventCount);

        $this->info("Found {$eventCount} {$eventLabel}.");

        $totalNotifications = 0;
        $events->each(function (Event $event) use (&$totalNotifications) {
            $attendeeCount = $event->attendees->count();
            $totalNotifications += $attendeeCount;
            $event->attendees->each(function ($attendee) use ($event) {
                $user = $attendee->user;
                $user->notify(new EventReminderNotification($event));
            });
        });

        $this->info("{$totalNotifications} event notification/s sent successfully.");
    }
}
