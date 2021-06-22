<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['isJson', 'JetStreamToken']], function() {

    // 1er étage

    Route::get('/', [ApiController::class, 'index']);

    Route::resource('/authors', AuthorController::class)->except('index', 'show')->middleware('auth:sanctum');
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{author}', [AuthorController::class, 'show']);

    Route::resource('/books', BookController::class)->except('index', 'show')->middleware('auth:sanctum');
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{book}', [BookController::class, 'show']);

    Route::resource('/categories', CategoryController::class)->except('index', 'show')->middleware('auth:sanctum');
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);

    // 2ème étage

    Route::resource('/authors/{author}/books', BookController::class)->except('index', 'show')->middleware('auth:sanctum');
    Route::get('/authors/{author}/books', [BookController::class, 'index']);
    Route::get('/authors/{author}/books/{book}', [BookController::class, 'show']);

    Route::resource('/categories/{category}/books', BookController::class)->except('index', 'show')->middleware('auth:sanctum');
    Route::get('/categories/{category}/books', [BookController::class, 'index']);
    Route::get('/categories/{category}/books/{book}', [BookController::class, 'show']);

});

//tokens
// admin 1APWZ799cVZgF7zxRgay9K50CICJZrHFnkr5IM3N
// editor xYXSMCvS8TxHthN7L38QaLsamvLuAHp40mYHjkzn
