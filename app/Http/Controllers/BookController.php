<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return BookCollection
     */
    public function index()
    {
        $books = Book::with('author','genre')
            ->withCount('copies')
            ->get();

        return $this->respondSuccess('List of books',[
            'books' => new BookCollection($books)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function store(BookRequest $request): JsonResponse
    {
        $book_data = $request->validated();

        $book = Book::query()->create($book_data);

        $book->load(['author','genre','copies'])->loadCount('copies');

        return $this->respondCreated('Book created',['book' => new BookResource($book)]);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        $book->load(['copies','author','genre'])->loadCount('copies');

        $book = new BookResource($book);

        return $this->respondSuccess('Details of book',['book' => $book]);
    }
}
