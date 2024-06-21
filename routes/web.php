<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\LoginController;

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

// Route::get('/user/login', [LoginController::class , 'index'])->name('user.login.show');
// Route::post('/login', [LoginController::class, 'login'])->name('user.login');
// Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout')->middleware('auth:user');
