<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('login');
});

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/welcome', function () {
    return view('welcome');
});

Route::post('/chat', 'App\Http\Controllers\AssistenteChat');

