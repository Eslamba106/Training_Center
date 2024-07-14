<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\GraduatedController;
use App\Http\Controllers\Admin\ModeratorController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\StudentRateController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\FinalGraduatedController;
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

Route::get('login_settings/show_info_log', [AdminLoginController::class ,'settings_show'])->name("admin.login_settings.index")->middleware('auth:admin');
Route::get('login_settings/edit_info_log', [AdminLoginController::class ,'settings_edit'])->name("admin.login_settings.edit")->middleware('auth:admin');
Route::put('login_settings/update_info_log', [AdminLoginController::class ,'settings_update'])->name("admin.login_settings.update")->middleware('auth:admin');
Route::post('/student_register/excel-sheet', [AdminLoginController::class,'import_excel'])->name("admin.student_register.import_excel")->middleware('auth:admin');

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
Route::get('/student/excel-sheet', [StudentController::class,'show_excel'])->name("admin.student.show_excel")->middleware('auth:admin');
Route::post('/student/excel-sheet', [StudentController::class,'import_excel'])->name("admin.student.import_excel")->middleware('auth:admin');
Route::get('/student/show' , [StudentController::class , 'show'])->name('admin.student.show')->middleware('auth:admin');

################################ Settings #######################

Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
Route::get('/settings/edit', [SettingsController::class, 'edit'])->name('admin.settings.edit');
Route::put('/settings/update/{id}', [SettingsController::class, 'update'])->name('admin.settings.update');

############################### Rate #############################

Route::get('/section/add_students/{id}', [SectionStudentController::class, 'index'])->name('admin.add_students')->middleware('auth:admin');
Route::post('/section/add_students/store', [SectionStudentController::class, 'store'])->name('admin.add_students.store')->middleware('auth:admin');
Route::get('/section/add_students/show/{id}', [SectionStudentController::class, 'show'])->name('admin.add_students.show')->middleware('auth:admin');
Route::get('/section_students/edit/{id}', [SectionStudentController::class, 'edit'])->name('admin.student_section_edit')->middleware('auth:admin');
Route::delete('/section/section_students/delete/', [SectionStudentController::class, 'delete'])->name('admin.student_section_delete')->middleware('auth:admin');
Route::put('/section_students/update/{id}', [SectionStudentController::class, 'update'])->name('admin.student_section_update')->middleware('auth:admin');

############################### Rate #############################

Route::get('/rate', [RateController::class, 'index'])->name('admin.rate')->middleware('auth:admin');
Route::post('/rate/store', [RateController::class, 'store'])->name('admin.rate.store')->middleware('auth:admin');
Route::get('/rate/edit/{id}', [RateController::class, 'edit'])->name('admin.rate.edit')->middleware('auth:admin');
Route::put('/rate/update/{id}',[RateController::class, 'update'])->name('admin.rate.update')->middleware('auth:admin');
Route::delete('/rate/delete', [RateController::class, 'delete'])->name('admin.rate.delete')->middleware('auth:admin');
############################# Spceific Rate #####################################
Route::get('/rate/{id}', [RateController::class, 'section_rate'])->name('admin.section_rate')->middleware('auth:admin');

#################################### Student Rate #################################
Route::get('rate/student_rate/{id}', [StudentRateController::class, 'index'])->name('admin.student_rate')->middleware('auth:admin');
Route::post('rate/student_rate/store', [StudentRateController::class, 'store'])->name('admin.student_rate.store')->middleware('auth:admin');


################################### Attendance ####################################

Route::get('/attendance/{id}' , [AttendanceController::class , 'index'])->name('admin.attendance.index')->middleware('auth:admin');
Route::post('/attendance/store' , [AttendanceController::class , 'store'])->name('admin.attendance.store')->middleware('auth:admin');
Route::get('/attendance/print/{id}' , [ AttendanceController::class , 'print'])->name('admin.attendance.print')->middleware('auth:admin');
Route::get('/attendance/report/{id}' , [ AttendanceController::class , 'report'])->name('admin.attendance.report')->middleware('auth:admin');
Route::post('search_attendance' , [ AttendanceController::class , 'Search_invoices'])->middleware('auth:admin');

################################## Geraduated From Section ########################

Route::get('/section/graduated/{id}', [GraduatedController::class ,'index'])->name('admin.graduated')->middleware('auth:admin');
Route::post('search_graduation' , [GraduatedController::class , 'search_graduation'])->middleware('auth:admin');

################################## Final Graduated ################################
Route::get('/final-graduated', [FinalGraduatedController::class , 'index'])->name('admin.final_graduated')->middleware('auth:admin');
Route::post('/final-graduated/store', [FinalGraduatedController::class , 'store'])->name('admin.final_graduated.store')->middleware('auth:admin');
Route::post('daynumber', [AttendanceController::class , 'dayNumber'])->name('admin.dayNumber')->middleware('auth:admin');
#################################################################################### 
// Route::get('/attendance/Search_customers_index' , [ AttendanceController::class , 'Search_customers_index'])->name('Search_customers_index');
// Route::post('/attendance/Search_customers' , [ AttendanceController::class , 'Search_customers'])->name('Search_customers');

