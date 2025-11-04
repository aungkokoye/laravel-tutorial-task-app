@extends('layout.main')

@section('header-title')
    show-book
@endsection

@section('page-title', 'Book Details')

@section('content')

    <div class="mb-4 flex items-center justify-end gap-4">
        <a href="{{ route('books.index') }}" class="btn-m btn-default "> Back To Book List</a>
        <a href="{{ route('books.reviews.create', $book) }}" class="btn-m btn-primary "> Add Review</a>
    </div>

    <div class="rounded-lg bg-gray-50 px-4 py-4 shadow-sm hover:shadow-md mb-4">
        <div class="flex items-center justify-between">
            <!-- Left side: title and author -->
            <div>
                <a href="{{ route('books.show', $book) }}"
                   class="text-xl text-gray-800 hover:text-blue-500">
                    {{ $book->title }}
                </a>
                <span class="block text-gray-600 text-sm">by {{ $book->author }}</span>
            </div>

            <!-- Right side: rating and review -->
            <div>
                <div class="text-gray-600 text-right">
                    {{ number_format($book->reviews_avg_rating, 1) ?? 0.0 }} <x-star-rating :rating="$book->reviews_avg_rating" />
                </div>
                <div class="text-gray-600 text-right">
                    {{ $book->reviews_count ?? 0 }} {{ Str::plural('review', $book->reviews_count) }}
                </div>
                <div class="text-gray-600 text-right">
                    Creates At: {{ $book->created_at->diffForHumans() }} | Updated At: {{ $book->updated_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-xl text-slate-500 mb-4"> Review List:</h1>

    @forelse($book->reviews as $review)
        <div class="rounded-lg bg-gray-200 px-4 py-4 shadow-sm hover:shadow-md mb-4">
            <div class="flex justify-between text-sm">
                <!-- Left side: title and author -->
                <div class="flex-1">
                    <p class="block text-gray-600"> {{ $review->review }}</p>
                </div>

                <!-- Right side: rating and review -->
                <div class="shrink-0 text-right">
                    <div class="text-gray-600">
                        {{ number_format($review->rating, 1) ?? 0.0 }}
                        <x-star-rating :rating="$review->rating" />
                    </div>
                    <div class="text-gray-600">
                        Creates At: {{ $review->created_at->diffForHumans() }}
                    </div>
                    <div class="text-gray-600">
                        Updated At: {{ $review->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-600"> No reviews found for this book. </p>
    @endforelse

@endsection
