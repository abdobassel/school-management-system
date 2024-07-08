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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/parent/dashboard', function () {
            return view('pages.parents.dashboard');
            // return 'ok parents';
        });


        //profile
        Route::get('student/profile', [ProfileStudentrController::class, 'index'])->name('profileStudent.index');

        Route::put('student/profile', [ProfileStudentrController::class, 'update'])->name('profileStudent.update');
    }
);
