<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\student\RateController;
use App\Http\Controllers\student\LoginController;
use App\Http\Controllers\student\SectionController;
use App\Http\Controllers\student\AttendanceController;
use App\Http\Controllers\student\StudentDashboardController;


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



Route::get('/login', [LoginController::class , 'index'])->name('student.login.show');
Route::post('/login', [LoginController::class, 'login'])->name('student.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('student.logout')->middleware('auth:student');


############################### Dashboard ###################################

Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard')->middleware('auth:student');


############################## Section ######################################

Route::get('/section' , [SectionController::class , 'index'])->name('student.section')->middleware('auth:student');


############################## Attendance ###################################

Route::get('/attendance/{id}' , [AttendanceController::class , 'index'])->name('student.attendance.show')->middleware('auth:student');

############################## Rates ########################################

Route::get('/rates', [RateController::class ,'index'])->name('student.rates')->middleware('auth:student');
Route::get('/finalRates', [RateController::class ,'final'])->name('student.final_rate')->middleware('auth:student');
