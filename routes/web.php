<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\ProjectMember;
use App\Livewire\ShowUsers;
use App\Models\Project;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('/');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/tarea/nueva/{project?}', [TaskController::class, 'newTaskView'])->name('newTask');

    Route::get('/proyecto/nuevo', function () {
        return view('projects.add-project-form');
    })->name('newProject');

    Route::get('/proyecto/{id}', [ProjectController::class, 'showProyect'])->name('showProyect')->middleware(ProjectMember::class);
});

Route::post('/addTask', [TaskController::class, 'addTask'])->name('addTask');
Route::post('/addProyect', [ProjectController::class, 'addProject'])->name('addProject');
Route::post('/deleteProject/{id}', [ProjectController::class, 'deleteProject'])->name('deleteProject');
