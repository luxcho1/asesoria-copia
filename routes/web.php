<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Chatbot;
use App\Http\Controllers\Chatbot2; 
use App\Http\Controllers\Chatbot3Controller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/chatbot', Chatbot::class);


Route::get('/chatbot2', function () {
    return view('chatbot2');
});

Route::post('/chatbot2', [Chatbot2::class, 'interact'])->name('chatbot2');

//version 1.2
Route::get('/chatbot3', function () {
    return view('chatbot3');
});

Route::post('/chatbot3', [Chatbot3Controller::class, 'submit'])->name('chatbot3.submit');

