<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppRouteProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Load your custom book routes
        Route::middleware('web')
            ->group(base_path('routes/task.php'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('review', function (Request $request) {
            $user = $request->user();

            if ($user) {
                return Limit::perHour(3)->by($user->id);
            }

            // For guests (not logged in)
            return Limit::perHour(3)->by($request->ip());
        });
    }
}
