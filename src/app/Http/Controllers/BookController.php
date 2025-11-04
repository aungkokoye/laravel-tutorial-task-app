<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->query('title');
        $filter = $request->query('filter');

        $books = Book::when($title, fn($q) => $q->title($title));
        match ($filter){
            'popular_last_month'        => $books->popularLastMonth(),
            'popular_last_6months'      => $books->popularLast6Months(),
            'highest_rated_last_month'  => $books->highestReviewLastMonth(),
            'highest_rated_last_6months'=> $books->highestReviewLast6Months(),
            default                     => $books->latest()->withCount('reviews')
                ->withAvg('reviews', 'rating')
        };

        $books = $books->paginate(10)->appends($request->query());

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book = cache()->remember(
                    'book-'.$book->id,
                        3600,
                        fn() => $book->load(['reviews' => fn($q) => $q->latest()])
                            ->loadAvg('reviews', 'rating')
                            ->loadCount('reviews')
        );
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
