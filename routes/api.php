<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::resource('books', BookController::class);
Route::post('/books', [BookController::class, 'index']);
Route::post('/books/create', [BookController::class, 'store']);
Route::post('/books/{id}', [BookController::class, 'show']);
Route::post('/books/{id}/edit', [BookController::class, 'update']);
Route::post('/login', [LoginController::class, 'login']);
