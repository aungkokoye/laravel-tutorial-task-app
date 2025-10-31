<?php

namespace Database\Seeders;

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
        // for seeders
        $this->call([
            TaskSeeder::class,
        ]);

        User::factory(5)->create();
        User::factory()->create([
            'name'      => 'Test Admin User',
            'email'     => 'test_admin@example.com',
            'password'  => 'admin',
        ]);
    }
}
