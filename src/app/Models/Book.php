<?php

namespace App\Models;

use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    /** @use HasFactory<BookFactory> */
    use HasFactory;

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Scope a query to only include books with titles matching the search term.
     * App\Models\Book::title('search term')->get();
     */
    public function scopeTitle(Builder $query, string $search): Builder
    {
        return $query->where('title', 'like', '%'.$search.'%');
    }

    /**
     * Scope a query to order books by number of reviews in descending order.
     *
     * reviews_count is a computed column added by withCount('reviews')
     *
     * App\Models\Book::popular(to: '2024-01-01', form: '2023-01-01')->get();
     * App\Models\Book::popular(to: '2024-01-01')->get();
     * App\Models\Book::popular(form: '2023-01-01')->get();
     * App\Models\Book::popular()->get();
     */
    public function scopePopular(Builder $query, ?string $from = null , ?string $to = null): Builder
    {
        return $query
            ->withCount(['reviews' => fn($q) => $this->filterByDate($q, $from, $to)])
            ->orderBy('reviews_count', 'desc');
    }

    /**
     * Scope a query to order items by the average rating of their reviews in descending order.
     *
     * reviews_avg_rating is a computed column added by withAvg('reviews', 'rating')
     *
     * App\Models\Book::averageRating(to: '2024-01-01', form: '2023-01-01')->get();
     * App\Models\Book::averageRating(to: '2024-01-01')->get();
     * App\Models\Book::averageRating(form: '2023-01-01')->get();
     * App\Models\Book::averageRating()->get();
 */
    public function scopeAverageRating(Builder $query, ?string $from = null , ?string $to = null): Builder
    {
        return $query
            ->withAvg(['reviews' => fn($q) => $this->filterByDate($q, $from, $to)], 'rating')
            ->orderBy('reviews_avg_rating', 'desc');
    }

    /**
     * Adds a condition to the query to filter results based on a minimum number of reviews.
     *
     * reviews_count is a computed column added by withCount('reviews')
     *
     * App\Models\Book::averageRating(to: '2024-01-01', from: '2023-01-01')
     * ->popular(to: '2024-01-01', from: '2023-01-01')->minimumReview(5)->get();
     */
    public function scopeMinimumReview(Builder $query, int $minimumReview): Builder
    {
        return $query->having('reviews_count', '>=', $minimumReview);
    }

    public function scopePopularLastMonth(Builder $query): Builder
    {
        return $query->popular(from: now()->subMonth(), to: now())
            ->AverageRating(from: now()->subMonth(), to: now())->minimumReview(2);
    }

    public function scopePopularLast6Months(Builder $query): Builder
    {
        return $query->popular(from: now()->subMonths(6), to: now())
            ->AverageRating(from: now()->subMonths(6), to: now())->minimumReview(5);
    }

    public function scopeHighestReviewLastMonth(Builder $query): Builder
    {
        return $query->AverageRating(from: now()->subMonth(), to: now())
            ->popular(from: now()->subMonth(), to: now())->minimumReview(2);
    }

    public function scopeHighestReviewLast6Months(Builder $query): Builder
    {
        return $query->AverageRating(from: now()->subMonths(6), to: now())
            ->popular(from: now()->subMonths(6), to: now())->minimumReview(5);
    }

    private function filterByDate(Builder $query, ?string $from, ?string $to): void
    {
        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        } elseif ($from) {
            $query->where('created_at', '>=', $from);
        } elseif ($to) {
            $query->where('created_at', '<=', $to);
        }
    }
}
