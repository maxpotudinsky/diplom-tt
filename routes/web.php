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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('/tasks/upd/{task_id}/{cell_id}', [\App\Http\Controllers\TaskController::class, 'upd']);

    Route::post('/edit/{id}', [\App\Http\Controllers\TaskController::class, 'edit']);

    Route::resource('/tasks', TaskController::class);

    Route::resource('/projects', ProjectController::class);

    Route::resource('/users', UserController::class);
});

