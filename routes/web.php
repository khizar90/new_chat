<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatsController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// routes/web.php


Route::get('/', [ChatsController::class , 'index']);
Route::redirect('/home', '/');
Route::get('messages', [ChatsController::class , 'fetchMessages']);
Route::post('messages', [ChatsController::class , 'sendMessage']);
Broadcast::routes(['middleware' => ['auth:sanctum']]);
