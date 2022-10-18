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
Route::get('/test-api', [ApplicationController::class, 'testSms'])->name('test-api');
Route::get('student/login', [AuthStudentController::class, 'index'])->name('create-login');
Route::post('/login/student', [AuthStudentController::class, 'store'])->name('student.login');

Route::group(['middleware' => ['student'], 'prefix' => 'student'], function () {
    Route::get('/', [DashboardController::class, 'student'])->name('student.dashboard');
    Route::get('/download', [StudentController::class, 'downloadPdf'])->name('student.download');
    Route::post('/logout', [AuthStudentController::class, 'destroy'])->name('student.logout');
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
