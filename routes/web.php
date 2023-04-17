<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;


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
    return view('index');
});

Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');


Route::middleware(['auth'])->group(function () {
    // Define routes for regular users
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/profile', [UserController::class, 'index'])->name('user.profile');
    // Define other user routes here...
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Define routes for admin users
    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', 'App\Http\Controllers\AdminController@users')->name('admin.users');
    // Define other admin routes here...
});

Auth::routes();



