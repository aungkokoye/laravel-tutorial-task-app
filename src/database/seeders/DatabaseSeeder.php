<?php

namespace Database\Seeders;

use App\Models\Attendee;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1000)->create();
        User::factory()->create([
            'name'      => 'Test Admin User',
            'email'     => 'test_admin@example.com',
            'password'  => 'admin',
        ]);

        // for seeders
        $this->call([
            TaskSeeder::class,
            BookReviewSeeder::class,
            EventSeeder::class,
            AttendeeSeeder::class,
        ]);

    }
}
