<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\StudentController;

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
    Route::get('/dashboard', function () {
        return response(auth()->user());
    });

    Route::get('/user', function () {
        return response(auth()->user());
    });
});
Route::middleware('guest')->group(function () {
    Route::post('admin/register', [UserController::class, 'register']);

    //Route::post('register',[UserController::class,'register']);
    Route::post('admin/login', [UserController::class, 'login']);

    Route::post('student/login', [StudentController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});
