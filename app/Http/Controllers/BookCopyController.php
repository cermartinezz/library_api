<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCopyRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookCopyController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param BookCopyRequest $request
     * @param Book $book
     * @return JsonResponse
     */
    public function store(BookCopyRequest $request, Book $book): JsonResponse
    {
        $book_copy = $request->validated();

        $copy = $book->copies()->create([
            'publisher'         => $book_copy['publisher'],
            'published_year'    => $book_copy['published_year']
        ]);

        return $this->respondCreated('Copy created',['copy' => $copy]);
    }
}
