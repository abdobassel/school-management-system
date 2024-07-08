<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ExamStudentrController;
use App\Http\Controllers\Student\ProfileStudentrController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/student/dashboard', function () {
            return view('pages.students.dashboard');
        });

        Route::get('/student/exams', [ExamStudentrController::class, 'index'])->name('studentExams.index');

        Route::get('/student/exams/show/{id}', [ExamStudentrController::class, 'show'])->name('studentExams.show');

        //profile
        Route::get('student/profile', [ProfileStudentrController::class, 'index'])->name('profileStudent.index');

        Route::put('student/profile', [ProfileStudentrController::class, 'update'])->name('profileStudent.update');
    }
);
