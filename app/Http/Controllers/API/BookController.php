<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
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
                'books' => Book::where('user_id', $user_id)->orderByDesc('id')->paginate(12)
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $val_data = $request->validated();

        $book = Book::create([
            'user_id' => $val_data['user_id'],
            'title' => $val_data['title'],
            'author' => $val_data['author'],
            'isbn' => $val_data['isbn'],
            'plot' => $val_data['plot'],
        ]);

        return response()->json([
            'success' => true,
            'book' => $book
        ]);
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
    public function update(UpdateBookRequest $request, string $book_id)
    {
        $val_data = $request->validated();

        $book = Book::where('id', $book_id)->first();


        $book->update([
            'user_id' => $val_data['user_id'],
            'title' => $val_data['title'],
            'author' => $val_data['author'],
            'isbn' => $val_data['isbn'],
            'plot' => $val_data['plot'],
        ]);

        return response()->json([
            'success' => true,
            'book' => $book
        ]);
    }

    public function update_total_readings(Request $request, string $book_id)
    {

        $request_user_id = $request->input('user_id');
        $total_readings = $request->input('total_readings');

        $book = Book::where('id', $book_id)->first();

        if ($book->user_id === (int)$request_user_id) {

            $book->update([
                'total_readings' => $total_readings
            ]);

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
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $book_id)
    {
        $request_user_id = $request->input('user_id');

        /* return response()->json([
            'request' => $request_user_id
        ]); */

        $book = Book::where('id', $book_id)->first();

        if ($book->user_id === (int)$request_user_id) {
            $book->delete();
        } else {
            return response()->json([
                'success' => false,
                'error' => "You cannot access this book!"
            ]);
        }

        return response()->json([
            'success' => true,
            'result' => 'Book deleted successfully!'
        ]);
    }
}
