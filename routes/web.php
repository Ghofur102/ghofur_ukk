<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UpdateProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Post\PhotoController;
use App\Http\Controllers\Post\LikeController;
use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfileController;
use App\Models\photos;

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

Route::get('/', function () {
    $photos = photos::has('likes')->orderBy('count_like', 'desc')->take(3)->get();
    $new_photos = photos::latest()->take(3)->get();
    return view('home', compact('photos', 'new_photos'));
})->name('dashboard');
Route::get('/gallery/{type}', [PhotoController::class, 'index'])->name('gallery');
Route::get('/postingan/{id}', [PhotoController::class, 'show'])->name('show.postingan');
Route::get('/other-profile/{id}', [ProfileController::class, 'other_profile'])->name('other.profile');

Route::middleware(['guest'])->group(function () {
    // tampilan login dan register
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    // proses login dan register
    Route::post('/login', [LoginController::class, 'process'])->name('process.login');
    Route::post('/register', [RegisterController::class, 'process'])->name('process.register');
    // forgot password view
    Route::get('/forgot-password', [ResetPasswordController::class, 'forget_password'])->name('password.request');
    // send email forgot password
    Route::post('/forgot-password', [ResetPasswordController::class, 'process_forget_password'])->name('password.email');
    // reset password view
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset_password'])->name('password.reset');
    // process reset password
    Route::post('/reset-password', [ResetPasswordController::class, 'process_reset_password'])->middleware('guest')->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    // profile
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    // change password
    Route::put('/change_password', [ResetPasswordController::class, 'change_password'])->name('change.password');
    // your gallery
    Route::get('/your-gallery', function () {
        return view('gallery');
    })->name('your.gallery');
    Route::put('/update-profile', [UpdateProfileController::class, 'update'])->name('update.profile');
    // logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // crud photos
    Route::post('/store-photo', [PhotoController::class, 'store'])->name('store.photo');
    Route::delete('/delete-photo/{id}', [PhotoController::class, 'destroy'])->name('destroy.photo');
    Route::put('/update-photo/{id}', [PhotoController::class, 'update'])->name('update.photo');
    // like postingan
    Route::post('/like-photo/{id}', [LikeController::class, 'like'])->name('like.photo');
    // crud comments
    Route::post('/store-commment/{id}', [CommentController::class, 'store'])->name('store.comment');
    Route::delete('/delete-comment/{id}', [CommentController::class, 'destroy'])->name('destroy.comment');
    Route::put('/update-comment/{id}', [CommentController::class, 'update'])->name('update.comment');
    // crud albums
    Route::get('/your-albums', function () {
        return view('albums');
    })->name('your.albums');
    Route::get('/show-album/{id}', [AlbumController::class, 'show'])->name('show.album');
    Route::post('/store-album', [AlbumController::class, 'store'])->name('store.album');
    Route::delete('/delete-album/{id}', [AlbumController::class, 'destroy'])->name('destroy.album');
    Route::put('/update-album/{id}', [AlbumController::class, 'update'])->name('update.album');
});
