<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\AuthStudentController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\ApplicationController;
use App\Http\Controllers\Frontend\StudentController;
use Illuminate\Support\Facades\Route;

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


//============ student ====================================
Route::get('/', [StudentController::class, 'index'])->name('index');
//Route::get('student/login', [AuthStudentController::class, 'index'])->name('create-login');
//Route::post('/login/student', [AuthStudentController::class, 'store'])->name('student.login');
//Route::post('/application', [ApplicationController::class, 'store']);


//Route::group(['middleware' => ['student'], 'prefix' => 'student'], function () {
//    Route::get('/', [DashboardController::class, 'dashboard'])->name('student.dashboard');
//    Route::get('/download', [StudentController::class, 'downloadPdf'])->name('student.download');
//    Route::post('/logout', [AuthStudentController::class, 'destroy'])->name('student.logout');
//});
//=========================================================


//Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
//    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//    Route::get('/pending', [DashboardController::class, 'getPending'])->name('pending');
//    Route::get('/literally', [DashboardController::class, 'getLiterally'])->name('literally');
//    Route::get('/meeting', [DashboardController::class, 'getMeetings'])->name('meeting');
//    Route::get('/invalid', [DashboardController::class, 'getInvalid'])->name('invalid');
//    Route::get('/approve', [DashboardController::class, 'getApprove'])->name('approve');
//    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
//});

require __DIR__ . '/auth.php';
