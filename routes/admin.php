<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\StudentRateController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ModeratorController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SectionStudentController;

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

######################### Login ################################
Route::get('/login', [AdminLoginController::class, 'index'])->middleware('guest')->name('admin.login.show');
Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');

################################## Dashboard ###################

Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth:admin');

################################# Section ######################
Route::get('/section', [SectionController::class, 'index'])->name('admin.section')->middleware('auth:admin');
Route::get('/section/fetch', [SectionController::class, 'fetchSection'])->name('admin.section.fetch')->middleware('auth:admin');
Route::post('/section/create', [SectionController::class, 'store'])->name('admin.section.store')->middleware('auth:admin');
Route::get('/section/edit/{id}', [SectionController::class, 'edit'])->name('admin.section.edit')->middleware('auth:admin');
Route::put('/section/update/{id}', [SectionController::class, 'update'])->name('admin.section.update')->middleware('auth:admin');
Route::delete('/section/delete', [SectionController::class, 'delete'])->name('admin.section.delete')->middleware('auth:admin');

################################ Moderators ######################

Route::get('/moderator', [ModeratorController::class, 'index'])->name('admin.moderator')->middleware('auth:admin');
Route::post('/moderator/store', [ModeratorController::class, 'store'])->name('admin.moderator.store')->middleware('auth:admin');
Route::get('/moderator/edit/{id}', [ModeratorController::class, 'edit'])->name('admin.moderator.edit')->middleware('auth:admin');
Route::put('/moderator/update/{id}', [ModeratorController::class, 'update'])->name('admin.moderator.update')->middleware('auth:admin');
Route::delete('/moderator/delete', [ModeratorController::class, 'delete'])->name('admin.moderator.delete')->middleware('auth:admin');
Route::get('/moderator/fetch', [ModeratorController::class, 'fetchSection'])->name('admin.moderator.fetch')->middleware('auth:admin');

################################ Students ######################

Route::get('/student', [StudentController::class, 'index'])->name('admin.student')->middleware('auth:admin');
Route::post('/student/store', [StudentController::class, 'store'])->name('admin.student.store')->middleware('auth:admin');
Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('admin.student.edit')->middleware('auth:admin');
Route::put('/student/update/{id}', [StudentController::class, 'update'])->name('admin.student.update')->middleware('auth:admin');
Route::delete('/student/delete', [StudentController::class, 'delete'])->name('admin.student.delete')->middleware('auth:admin');
Route::get('/student/fetch', [StudentController::class, 'fetchSection'])->name('admin.student.fetch')->middleware('auth:admin');

################################ Settings #######################

Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
Route::get('/settings/edit', [SettingsController::class, 'edit'])->name('admin.settings.edit');
Route::put('/settings/update/{id}', [SettingsController::class, 'update'])->name('admin.settings.update');

############################### Rate #############################

Route::get('/section/add_students/{id}', [SectionStudentController::class, 'index'])->name('admin.add_students')->middleware('auth:admin');
Route::post('/section/add_students/store', [SectionStudentController::class, 'store'])->name('admin.add_students.store')->middleware('auth:admin');
Route::get('/section/add_students/show/{id}', [SectionStudentController::class, 'show'])->name('admin.add_students.show')->middleware('auth:admin');

############################### Rate #############################

Route::get('/rate', [RateController::class, 'index'])->name('admin.rate')->middleware('auth:admin');
Route::post('/rate/store', [RateController::class, 'store'])->name('admin.rate.store')->middleware('auth:admin');
Route::get('/rate/edit/{id}', [RateController::class, 'edit'])->name('admin.rate.edit')->middleware('auth:admin');
Route::put('/rate/update/{id}',[RateController::class, 'update'])->name('admin.rate.update')->middleware('auth:admin');
Route::delete('/rate/delete', [RateController::class, 'delete'])->name('admin.rate.delete')->middleware('auth:admin');


#################################### Student Rate #################################
Route::get('rate/student_rate/{id}', [StudentRateController::class, 'index'])->name('admin.student_rate')->middleware('auth:admin');
Route::post('rate/student_rate/store', [StudentRateController::class, 'store'])->name('admin.student_rate.store')->middleware('auth:admin');


################################### Attendance ####################################

Route::get('/attendance/{id}' , [AttendanceController::class , 'index'])->name('admin.attendance.index');
Route::post('/attendance/store' , [AttendanceController::class , 'store'])->name('admin.attendance.store');
Route::get('/attendance/print/{id}' , [ AttendanceController::class , 'print'])->name('admin.attendance.print');

// Route::resource('attendance', AttendanceController::class);

// Route::post('attendance','StudentController@attendance')->name('attendance');
// Route::post('edit_attendance','StudentController@editAttendance')->name('attendance.edit');
// Route::get('attendance_report','StudentController@attendanceReport')->name('attendance.report');
// Route::post('attendance_report','StudentController@attendanceSearch')->name('attendance.search');