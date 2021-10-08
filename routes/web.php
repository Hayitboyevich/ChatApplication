<?php

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

Route::get('/', function () {
    broadcast(new \App\Events\WebsocketDemoEvent('Shahzod'));
    return view('welcome');
});

Route::get('/chats', [ChatsController::class, 'index'])->name('index');
Route::get('/messages', [ChatsController::class, 'fetchMessages'])->name('fetchMessages');
Route::post('/sendMessages', [ChatsController::class, 'sendMessage'])->name('sendMessage');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

