<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\ReviewFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /** @use HasFactory<ReviewFactory> */
    use HasFactory;

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    protected static function booted(): void
    {
        static::created(fn ($review) => cache()->forget('book-'.$review->book_id));
        static::updated(fn ($review) => cache()->forget('book-'.$review->book_id));
        static::deleted(fn ($review) => cache()->forget('book-'.$review->book_id));
    }
}
