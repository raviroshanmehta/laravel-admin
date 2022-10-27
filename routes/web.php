<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {  return view('welcome'); });
Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/password', [HomeController::class, 'password'])->name('password.update');
    Route::post('/profile', [HomeController::class, 'profile'])->name('profile.update');
});
Route::prefix('superadmin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/admins', [SuperAdminController::class, 'admins'])->name('superadmin.admins');
    Route::post('/admins/add', [SuperAdminController::class, 'admin'])->name('superadmin.admins.add.post');
    Route::get('/admins/add', [SuperAdminController::class, 'admin'])->name('superadmin.admins.add');
    Route::get('/admins/{id}/update', [SuperAdminController::class, 'admin'])->name('superadmin.admins.update');
});
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/add', [AdminController::class, 'user'])->name('admin.users.add.post');
    Route::get('/users/add', [AdminController::class, 'user'])->name('admin.users.add');
    Route::get('/users/{id}/update', [AdminController::class, 'user'])->name('admin.users.update');
});
Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});