<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\moderator\LoginController;
use App\Http\Controllers\moderator\SectionController;
use App\Http\Controllers\moderator\StudentController;
use App\Http\Controllers\moderator\AttendanceController;
use App\Http\Controllers\moderator\ModeratorDashboardController;



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



Route::get('/login', [LoginController::class , 'index'])->name('moderator.login.show');
Route::post('/login', [LoginController::class, 'login'])->name('moderator.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('moderator.logout')->middleware('auth:moderator');


############################### Dashboard ###################################

Route::get('/dashboard', [ModeratorDashboardController::class, 'index'])->name('moderator.dashboard')->middleware('auth:moderator');


############################## Section ######################################

Route::get('/section' , [SectionController::class , 'index'])->name('moderator.section')->middleware('auth:moderator');

############################## Student ######################################

Route::get('/student' , [StudentController::class , 'index'])->name('moderator.students')->middleware('auth:moderator');


############################## Attendance ###################################

Route::get('/attendance' , [AttendanceController::class , 'index'])->name('moderator.attendance.show')->middleware('auth:moderator');
Route::post('/attendance/store' , [AttendanceController::class , 'store'])->name('moderator.attendance.store')->middleware('auth:moderator');
Route::get('/attendance/print/{id}' , [ AttendanceController::class , 'print'])->name('moderator.attendance.print')->middleware('auth:moderator');
