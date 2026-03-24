<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::resource('tasks', TaskController::class)->middleware('auth');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/settings.php';


Route::get('/login', function () {
    return view('login');
});

Route::get('/welcome', function () {
    return view('welcome-first');
})->middleware('auth')->name('welcome-first');


require __DIR__ . '/auth.php';
