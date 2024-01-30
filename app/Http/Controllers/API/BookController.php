<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');

        return response()->json([
            'success' => true,
            'result' => [
                'books' => Book::where('user_id', $user_id)->paginate(12)
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $book_id)
    {
        $request_user_id = $request->input('user_id');

        $book = Book::where('id', $book_id)->first();

        if ($book->user_id === (int)$request_user_id) {
            return response()->json([
                'success' => true,
                'result' => $book
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => "You cannot access this book!"
            ]);
        }
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
    public function destroy(Request $request, string $book_id)
    {
        $request_user_id = $request->query('user_id');

        $book = Book::where('id', $book_id)->first();

        if ($book->user_id === $request_user_id) {
            $book->delete();
        } else {
            return response()->json([
                'success' => false,
                'result' => "You cannot access this book!"
            ]);
        }

        return response()->json([
            'success' => true,
            'error' => 'Book deleted successfully!'
        ]);
    }
}
