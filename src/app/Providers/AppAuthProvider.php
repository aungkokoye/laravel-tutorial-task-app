<?php

namespace App\Providers;

use App\Models\Attendee;
use App\Models\User;
use App\Policies\AttendeePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Event;

class AppAuthProvider extends ServiceProvider
{

    public function register(): void
    {

    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate definitions can go here if needed in the future
        collect(['update-event', 'delete-event'])
            ->each(fn($ability) => Gate::define($ability, fn(User $user, Event $event) => $user->id === $event->user_id));

        // Policy definitions can go here if needed in the future
        Gate::policy(Attendee::class, AttendeePolicy::class);
    }
}
