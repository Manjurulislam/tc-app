<?php

use App\Http\Controllers\Auth\AuthCollegeController;
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

//Route::group(['middleware' => ['student'], 'prefix' => 'student'], function () {
//    Route::get('/', [DashboardController::class, 'dashboard'])->name('student.dashboard');
//    Route::get('/download', [StudentController::class, 'downloadPdf'])->name('student.download');
//    Route::post('/logout', [AuthStudentController::class, 'destroy'])->name('student.logout');
//});


//==================== college ===============================
Route::get('college-login', [AuthCollegeController::class, 'index'])->name('college-login');
Route::post('login/college', [AuthCollegeController::class, 'store'])->name('college.login');

Route::group(['middleware' => ['college'], 'prefix' => 'college'], function () {
    Route::get('/', [DashboardController::class, 'college'])->name('college.dashboard');
    Route::post('/logout', [AuthCollegeController::class, 'destroy'])->name('college.logout');
});


//=========================================================


Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/application', [DashboardController::class, 'getPending'])->name('application');
    Route::get('/approve', [DashboardController::class, 'getApprove'])->name('approve');
    Route::get('/comments', [DashboardController::class, 'comments'])->name('comments');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

require __DIR__ . '/auth.php';
