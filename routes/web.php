<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update/{id}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/tasks/create', [\App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/store', [\App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');

    Route::get('/projects/get', [\App\Http\Controllers\HomeController::class, 'get']);

    Route::post('/tasks/change', [\App\Http\Controllers\TaskController::class, 'changeStatus']);
    Route::get('/tasks/change/getStatus', [\App\Http\Controllers\TaskController::class, 'getStatus']);

    Route::post('/tasks/{taskId}/comment', [\App\Http\Controllers\CommentController::class, 'create'])->name('comment');

    Route::get('/tasks/{taskId}/comment/getComment', [\App\Http\Controllers\CommentController::class, 'get']);

    Route::group(['middleware' => 'auth.admin.director'], function () {
//        Route::resource('/tasks', TaskController::class);
        Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
        Route::get('/tasks/show/{id}', [\App\Http\Controllers\TaskController::class, 'show'])->name('tasks.show');
        Route::post('/tasks/update/{id}', [\App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
        Route::get('/tasks/{id}/edit', [\App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
        Route::get('/tasks/destroy/{id}', [\App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');

        Route::resource('/projects', ProjectController::class);
        Route::resource('/users', UserController::class);
    });
});
