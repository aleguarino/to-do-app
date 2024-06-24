<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', function () {
    if (auth()->check()) {
        return view('welcome');
    }
    return view('auth.register');
})->name('/');

Route::get('/tarea/nueva', function () {
    return view('task.add-task-form');
})->name('newTask');

Route::post('/addTask', [TaskController::class, 'addTask'])->name('addTask');
