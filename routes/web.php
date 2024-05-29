<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassroomController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {


        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
        Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
        Route::delete('/grades/{id}', [GradeController::class, 'destroy'])->name('grades.destroy');

        Route::patch('/grades', [GradeController::class, 'update'])->name('grades.update');
        // classrooms
        Route::get('/classrooms', [ClassroomController::class, 'index'])->name('Classrooms.index');

        Route::patch('/classrooms', [ClassroomController::class, 'update'])->name('Classrooms.update');
        Route::delete('/classrooms', [ClassroomController::class, 'destroy'])->name('Classrooms.destroy');
        Route::post('/classrooms', [ClassroomController::class, 'store'])->name('Classrooms.store');

        Route::post('/classrooms/delete-all', [ClassroomController::class, 'deleteAll'])->name('Classrooms.delete_all');
        Route::post('/filter-Classes', [ClassroomController::class, 'filterClasses'])->name('filter_classes');

        //sections 
        Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
        // classes options select 
        Route::get('/classes/{id}', [SectionController::class, 'getclasses']);
        //store
        Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
        Route::patch('/sections', [SectionController::class, 'update'])->name('sections.update');
        Route::delete('/sections', [SectionController::class, 'destroy'])->name('sections.destroy');

        Route::view('add_parent', 'livewire.Show_Form');


        // teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('/teachers/create', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/edit/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::patch('/teachers/update', [TeacherController::class, 'update'])->name('teachers.update');
    }

);
Route::get('/test', function () {
    return view('test');
});
