<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

Route::resource('tasks', TaskController::class)->middleware('auth');

Route::get('/', function () {
    $hasTasks = auth()->user()->tasks()->exists();

    if (!$hasTasks) {
        return view('pages.welcome');
    }
      return view('pages.home');
})->name('pages.home')->middleware('auth');

require __DIR__ . '/settings.php';


require __DIR__ . '/auth.php';


Route::get('/stats', [TaskController::class, 'stats'])
    ->name('stats')
    ->middleware('auth');
