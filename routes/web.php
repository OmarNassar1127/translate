<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/translate', function () {
    return view('translate');
})->name('translate.page');

Route::view('/login', 'login')->name('login.page');
Route::view('/register', 'register')->name('register.page');
Route::post('/translate', [TranslationController::class, 'translate'])->name('api.translate');
