<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCopyController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GenreController;
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

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/auth/user', [AuthController::class,'index']);
    Route::resource('/books', BookController::class);
    Route::resource('/books/{book}/copies', BookCopyController::class);
    Route::post('/checkout/{copy}', [CheckoutController::class,'store']);
});

Route::get('/authors', [AuthorController::class,'index']);
Route::get('/genres', [GenreController::class,'index']);

Route::post('/auth/register', [AuthController::class,'register']);
Route::post('/auth/login', [AuthController::class,'login']);

