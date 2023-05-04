<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCopyController;
use App\Http\Controllers\CheckoutController;
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
    Route::resource('/books', BookController::class);
    Route::post('/books/{book}/copy', [BookCopyController::class,'store']);
    Route::post('/checkout/{copy}', [CheckoutController::class,'store']);
});

Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);

