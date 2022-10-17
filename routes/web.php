<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
Route::get('/tickets', function () {
    return view('tickets');
})->middleware(['auth', 'verified'])->name('tickets');
*/
Route::get('/tickets', [TicketController::class,'showList'])->name('tickets');
Route::get('/ticket/{id}', [TicketController::class,'show']);

Route::get('/createPost', function () {
    return view('createPost');
})->middleware(['auth', 'verified'])->name('createPost');;

Route::post('store-ticket', [TicketController::class, 'store'])->middleware(['auth', 'verified']);

Route::post('store-comment', [CommentController::class, 'store'])->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
