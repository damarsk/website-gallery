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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/signin', [AuthController::class, 'signin'])->name('login');
Route::get('/signup', [AuthController::class, 'signup'])->name('register');
Route::post('/signin_process', [AuthController::class, 'signin_process'])->name('signin_process');
Route::post('/signup_process', [AuthController::class, 'signup_process'])->name('signup_process');

Route::middleware(['checklogin'])->group(function () {
    Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
    Route::get('/tambah', [AlbumController::class, 'tambahAlbum'])->name('tambah.album');
    Route::post('/album', [AlbumController::class, 'store'])->name('album');
    Route::post('/signout', [AuthController::class, 'signout'])->name('signout');
});