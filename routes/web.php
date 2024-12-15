<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

// Route untuk user yang belum login
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/signin', [AuthController::class, 'signin'])->name('login');
    Route::get('/signup', [AuthController::class, 'signup'])->name('register');
    Route::post('/signin_process', [AuthController::class, 'signin_process'])->name('signin_process');
    Route::post('/signup_process', [AuthController::class, 'signup_process'])->name('signup_process');
});

// Route untuk user yang sudah login
Route::middleware(['checklogin'])->group(function () {
    Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
    Route::get('/tambah', [AlbumController::class, 'tambahAlbum'])->name('tambah.album');
    Route::post('/album', [AlbumController::class, 'store'])->name('album');
    Route::post('/signout', [AuthController::class, 'signout'])->name('signout');
    
    // Route untuk admin
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/users', [AdminController::class, 'listUsers'])->name('admin.users.index');
        Route::get('/photos', [AdminController::class, 'listPhotos'])->name('admin.photos.index');
        // Manage User
        Route::get('/users/{id}', [AdminController::class, 'showUser'])->name('admin.users.show');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
        // Manage Photo
        Route::get('/photos/{id}', [AdminController::class, 'showPhoto'])->name('admin.photos.show');
        Route::patch('/photos/{id}/edit', [AdminController::class, 'editPhoto'])->name('admin.photos.edit');
    });
});