<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::get('/', [indexController::class, 'index'])
    ->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

Route::get('/addpost', [PostController::class, 'create'])
    ->middleware('auth','verified')->name('addpost');

Route::post('/addpost', [PostController::class, 'store'])->middleware('auth');

Route::get('/allposts', [PostController::class, 'index'])->middleware('auth')
    ->name('allposts');

Route::get('/post/{id}', [PostController::class, 'show'])
    ->name('getpost');

Route::post('/changeavatar/{id}', [UserController::class, 'changeAvatar'])
    ->middleware('auth')->name('changeavatar');

Route::post('/update/{id}', [PostController::class, 'update'])
    ->middleware('auth')->name('updatevision');

Route::get('/delete/{id}', [PostController::class, 'delete'])
    ->middleware('auth')->name('deletepost');

Route::get('editpost/{id}',  [PostController::class,'editPost'])
    ->middleware('auth')->name('editpost');

Route::post('editpost/{id}',  [PostController::class,'updatePost'])
    ->middleware('auth')->name('updatepost');

require __DIR__.'/auth.php';
