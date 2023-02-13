<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\user\UserAuthController;
use App\Http\Controllers\UserDashboardController;
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

Route::get('/', function () {
    return redirect('/login');
});

/**
 * Registeration And Login routes
 */
Route::controller(UserAuthController::class)->group(function () {
    Route::get('/registeration', 'registeration')->name('registeration');
    Route::post('/registeration', 'user_register_data')->name('user_register_data');

    // Route::get('/otpVerify','otpVerify')->name('otpVerify');
    // Route::post('/otpVerify', 'user_otp')->name('user_otp');

    Route::get('/verification/{email}/{id}', 'email_link_verification')->name('verification');
    Route::get('/verifysuccess', 'verifysuccess')->name('verifysuccess');
    Route::post('/otp_verify', 'email_otp_verify')->name('otp_verify');

    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'user_login_data')->name('user_login_data');

    Route::get('/logout', 'logout')->name('logout');
    Route::get('otp', 'user_otp_verify')->name('otp');
    Route::post('/resend_otp', 'resend_otp')->name('resend_otp');

    Route::post('/forgetPassword', 'forgetPassword')->name('forgetPassword');
    Route::post('/otp_verify_password', 'otp_verify_password')->name('otp_verify_password');
    Route::post('/resetPassword', 'resetPassword')->name('resetPassword');
    Route::get('/newpassword', 'newpassword')->name('newpassword');
});

/**
 * Dashboard routes
 */
Route::group(['middleware' => ['web', 'checkAdmin']], function () {
    Route::group(['prefix' => '/admin', 'as' => 'admin.'], function () {
        Route::controller(UserDashboardController::class)->group(function () {
            // Route::get('/admin/dashboard', 'admindashboard')->name('admindashboard');
            // ->middleware('userauth')
            Route::get('/', 'admindashboard')->name('dashboard');
        });
        /**
         * Subject routes
         */
        Route::controller(SubjectController::class)->group(function () {
            Route::get('/subject', 'index')->name('subject');
            Route::post('/add-subject', 'addSuject')->name('addSuject');

        });

        /**
         * Exam routes
         */
        Route::controller(ExamController::class)->group(function () {
            Route::get('/exam', 'index')->name('exam');
            Route::post('/add-exam', 'addExam')->name('addExam');
        });
        
    });
});

/**
 * students routes
 */

Route::group(['middleware' => ['web', 'checkStudent']], function () {
    Route::group(['prefix' => '/student', 'as' => 'student.'], function () {
        Route::controller(UserDashboardController::class)->group(function () {
            Route::get('/', 'studentdashboard')->name('studentdashboard');
        });
    });
});

/**
 * package routes
 */
Route::controller(PackageController::class)->group(function () {
    Route::get('/package', 'index')->name('package');
});
