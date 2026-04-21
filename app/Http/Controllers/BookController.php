<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    public function index()
    {
        $books = Auth::user()->books()->get();
        return BookResource::collection($books);
    }

    public function store(StoreBookRequest $request)
    {

        $book = Auth::user()->books()->create($request->validated());

        return new BookResource($book);
    }

    public function show(Book $book)
    {
        Gate::authorize('viewOrModify', $book);
        return new BookResource($book);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        Gate::authorize('viewOrModify', $book);
        $book->update($request->validated());

        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        Gate::authorize('viewOrModify', $book);
        $book->delete();

        return response()->noContent();
    }
}
