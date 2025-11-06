<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookReviewRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseControllers;

class ReviewController extends BaseControllers
{
    public function __construct()
    {
        $this->middleware('throttle:review')->only(['store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new review for the book.
     */
    public function create(Book $book)
    {
        return view('books.reviews.create', ['book' => $book]);
    }

    /**
     * Store a newly created the book's review in DB.
     */
    public function store(BookReviewRequest $request, Book $book)
    {
        $book->reviews()->create($request->validated());

        return redirect()->route('books.show', $book)
            ->with('success', 'Review added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
