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

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');

Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts');
Route::get('/posts/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::post('/posts/comment/{id}', [\App\Http\Controllers\PostController::class, 'comment'])->name('comment');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth');
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'registration'])->name('registration');
    Route::get('/forgot-password', [\App\Http\Controllers\AuthController::class, 'showForgotPasswordForm'])->name('forgot');
    Route::post('/forgot-password', [\App\Http\Controllers\AuthController::class, 'forgotPassword'])->name('forgotpassword');
});

Route::get('/contact-form', [\App\Http\Controllers\IndexController::class, 'showContactForm'])->name('contactform');
Route::post('/contact-form', [\App\Http\Controllers\IndexController::class, 'sendContactForm'])->name('sendcontactform');

