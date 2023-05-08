<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCopyController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    Route::put('/checkout/{checkout}', [CheckoutController::class,'update']);
    Route::get('/user/checkouts', [CheckoutController::class,'index']);
    Route::get('/authors', [AuthorController::class,'index']);
    Route::get('/genres', [GenreController::class,'index']);
    Route::get('/roles', [RoleController::class,'index']);
    Route::resource('/users', UserController::class);
});

Route::post('/auth/login', [AuthController::class,'login']);

