<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home2');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Auth::routes();

Route::get('/postingan-anda', [App\Http\Controllers\HomeController::class, 'index'])->name('postingan.anda');
Route::get('/gallery', [App\Http\Controllers\ViewController::class, 'gallery'])->name('gallery');
Route::get('/show_post/{slug}', [App\Http\Controllers\ViewController::class, 'show_post'])->name('show.post');
Route::get('/profile-oranglain/{id}', [ViewController::class, 'profile_oranglain'])->name('profile.oranglain');
Route::middleware(['auth'])->group(function () {
    Route::resource('/postingan', PostsController::class);
    Route::post('/like-postingan/{sender}/{recipient}/{postingan}', [LikesController::class, 'like_postingan'])->name('like.postingan');
    Route::post('/like-comment/{sender}/{recipient}/{comment}', [LikesController::class, 'like_comment'])->name('like.comment');
    Route::get('/album', [AlbumController::class, 'index']);
    Route::post('/album/{id}', [AlbumController::class, 'process']);
    Route::resource('/komentar', CommentsController::class);
    Route::get('/profile', [ViewController::class, 'profile'])->name('profile');
    Route::put('/profile-update/{id}', [HomeController::class, 'profile_update'])->name('profile.update');
});
