<?php

namespace App\Console\Commands;

use App\Jobs\EventReminderJob;
use App\Models\Event;
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
    public function handle(): void
    {
        $events = Event::with('attendees.user')
            ->where('start_time', '>=', now())
            ->where('start_time', '<=', now()->addDay())
            ->get();

        $eventCount = $events->count();

        if($eventCount) {
            EventReminderJob::dispatch($events)
                ->onConnection(config('queue.queue_connection'))
                ->onQueue(config('queue.notification_queue'));
        }

        $eventLabel = Str::plural('event', $eventCount);
        $this->info("Found {$eventCount} {$eventLabel}.");
        $this->info("Event notification/s sent successfully.");
    }
}
