<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return BookResource::collection(Book::paginate(10));
    }

    public function store(StoreBookRequest $request): BookResource
    {
        $book = Book::create($request->safe()->all());
        
        return new BookResource($book);
    }

    public function show(Book $book): BookResource
    {
        return new BookResource($book);
    }

    public function update(UpdateBookRequest $request, Book $book): BookResource
    {
        $book->update($request->safe()->all());

        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->noContent();
    }
}