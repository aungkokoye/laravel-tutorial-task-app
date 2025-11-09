<?php

namespace App\Console\Commands;

use App\Jobs\TestQueueJob;
use Illuminate\Console\Command;

class TestQueue extends Command
{
    protected $signature = 'app:test-queue-job';

    protected $description = 'Command for Test Queue Job';

    public function handle(): void
    {
        TestQueueJob::dispatch()
            ->onConnection(config('queue.queue_connection'))
            ->onQueue(config('queue.test_queue'));
        $this->info("TestQueueJob dispatched successfully!");
    }
}
