@extends('layout.main')

@section('header-title')
    main-book
@endsection

@section('page-title', 'Book List')

@section('content')
    <form method="GET" action="{{ route('books.index') }}" class="mb-4 flex items-center">
        <input type="text" name="title" placeholder="Search By Title" value="{{ request('title') }}"
               class="input mr-2 ring-1 ring-gray-200 shadow-sm h-10">
        <input type="hidden" name="filter" value="{{ request('filter') }}">
        <button type="submit" class="btn-m btn-primary mr-2 h-10">Search</button>
        <a href="{{ route('books.index') }}" class="btn-m btn-default mr-2 h-10">Reset</a>
    </form>

    <div class="filter-container">
        @php
            $filters = [
                ''                              => 'Latest',
                'popular_last_month'            => "Popular Last Month",
                'popular_last_6months'          => "Popular Last 6 Months",
                'highest_rated_last_month'      => "Highest Rated Last Month",
                'highest_rated_last_6months'    => "Highest Rated Last 6 Months",
            ];


        @endphp

        @foreach($filters as $filterKey => $filterLabel)
            <a href="{{ route('books.index', ['title' => request('title'), 'filter' => $filterKey]) }}"
               @class([
                   'filter-item',
                   'bg-blue-200 text-blue-800 font-semibold' =>
                   request('filter') === $filterKey || (empty(request('filter')) && $filterKey === ''),
               ])
            >
                {{ $filterLabel }}
            </a>
        @endforeach
    </div>


    <ul>
        @forelse($books as $book)
            <li class="mb-4">
                <div class="rounded-lg bg-gray-200 px-4 py-4 shadow-sm hover:shadow-md">
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
                                {{ number_format($book->reviews_avg_rating, 1) }}
                            </div>
                            <div class="text-gray-600 text-right">
                                Out of {{ $book->reviews_count }}
                                {{ Str::plural('review', $book->reviews_count ) }}
                            </div>
                        </div>

                    </div>
                </div>
            </li>
        @empty
            <li>No tasks found.</li>
        @endforelse
    </ul>

    <div>
        {{ $books->links() }}
    </div>
@endsection
