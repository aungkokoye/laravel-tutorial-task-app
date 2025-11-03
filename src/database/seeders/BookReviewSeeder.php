<?php

namespace Database\Seeders;

use App\Models\Book;

use App\Models\Review;
use Illuminate\Database\Seeder;

class BookReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(34)->create()->each(function ($book) {
            $reviews = fake()->numberBetween(5, 40);
            Review::factory($reviews)
                ->good()
                ->for($book)
                ->create();
        });

        Book::factory(33)->create()->each(function ($book) {
            $reviews = fake()->numberBetween(5, 30);
            Review::factory($reviews)
                ->average()
                ->for($book)
                ->create();
        });

        Book::factory(33)->create()->each(function ($book) {
            $reviews = fake()->numberBetween(5, 30);
            Review::factory($reviews)
                ->bad()
                ->for($book)
                ->create();
        });
    }
}
