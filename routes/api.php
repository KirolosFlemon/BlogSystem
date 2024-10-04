<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    // Registration
    Route::post('register', [RegisterController::class, 'register'])->name('auth.register');
    // Login
    Route::post('login', [LoginController::class, 'login'])->name('auth.login');
});

Route::prefix('admin')->middleware('auth:api')->group(function () {
    // User Routes
    Route::prefix('user')->namespace('User')->group(function () {
        // Get all Users
        Route::get('all', [UserController::class, 'all'])->name('user.all');
        // Get a specific User by ID
        Route::get('get', [UserController::class, 'get'])->name('user.get');
        // Create a new User
        Route::post('create', [UserController::class, 'create'])->name('user.create');
        // Update an existing User
        Route::post('update', [UserController::class, 'update'])->name('user.update');
        // Delete a User
        Route::delete('delete', [UserController::class, 'delete'])->name('user.delete');
        // Get soft deleted Users
        Route::get('get-delete-soft', [UserController::class, 'getSoftDeleted'])->name('user.get-delete-soft');
        // Restore a soft deleted User
        Route::post('restore', [UserController::class, 'restore'])->name('user.restore');
    });
    // Post Routes
    Route::prefix('post')->namespace('Post')->group(function () {
        // Get all Posts
        Route::get('all', [PostController::class, 'all'])->name('post.all');
        // Get a specific Post by ID
        Route::get('get', [PostController::class, 'get'])->name('post.get');
        // Create a new Post
        Route::post('create', [PostController::class, 'create'])->name('post.create');
        // Update an existing Post
        Route::post('update', [PostController::class, 'update'])->name('post.update');
        // Delete a Post
        Route::delete('delete', [PostController::class, 'delete'])->name('post.delete');
        // Get soft deleted Posts
        Route::get('get-delete-soft', [PostController::class, 'getSoftDeleted'])->name('post.get-delete-soft');
        // Restore a soft deleted Post
        Route::post('restore', [PostController::class, 'restore'])->name('post.restore');
    });
});
