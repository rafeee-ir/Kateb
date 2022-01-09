<?php

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
Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/activities', [App\Http\Controllers\LogController::class, 'index'])->name('activities');
    Route::get('/activities/me', [App\Http\Controllers\LogController::class, 'myActivities'])->name('myActivities');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');

//Projects
    Route::resource('projects', \App\Http\Controllers\ProjectController::class);
    Route::resource('comments', \App\Http\Controllers\CommentController::class);
});
