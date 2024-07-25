<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ParentController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    // admin api 
    // 1 get students -teachers -etc....
    Route::prefix('admin')->group(function () {
        // auth logout 
        Route::post('logout', [AdminController::class, 'logout'])->middleware('auth:sanctum');


        Route::get('get_all_students', [AdminController::class, 'get_all_students']);
        Route::get('get_all_teachers', [AdminController::class, 'get_all_teachers']);
        Route::get('get_all_parents', [AdminController::class, 'get_all_parents']);
        Route::get('get_genders', [AdminController::class, 'get_genders']);

        Route::get('get_specializations', [AdminController::class, 'get_specializations']);

        Route::post('create_teacher', [AdminController::class, 'create_teacher']);
        Route::post('update_teacher', [AdminController::class, 'updateTeacher']);
    });
});
Route::middleware('guest')->group(function () {


    Route::prefix('student')->group(function () {
        Route::post('login', [StudentController::class, 'login']);
        Route::post('logout', [StudentController::class, 'logout'])->middleware('auth:sanctum');
    });

    Route::prefix('teacher')->group(function () {
        Route::post('login', [TeacherController::class, 'login']);
        Route::post('logout', [TeacherController::class, 'logout'])->middleware('auth:sanctum');
    });

    Route::prefix('parent')->group(function () {
        Route::post('login', [ParentController::class, 'login']);
        Route::post('logout', [ParentController::class, 'logout'])->middleware('auth:sanctum');
    });
    Route::prefix('admin')->group(function () {
        Route::post('register', [AdminController::class, 'register']);
        Route::post('login', [AdminController::class, 'login']);
    });
});
