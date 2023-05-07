<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCopyRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookCopyController extends ApiController
{

    public function index(Request $request, Book $book)
    {
        $book->load(['author',
            'genre',
            'copies.book',
            'allCheckouts' => ['user','copy'],
            'rentedCopies' => ['user','copy']
        ])->loadCount(['rentedCopies','copies']);

        return $this->respondSuccess('List copies', ['book' => new BookResource($book)]);
    }

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
