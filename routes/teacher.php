<?php

use App\Student;
use App\Teacher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\TeacherStudentController;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {

            $ids = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
            $data['count_sections'] = $ids->count();
            $data['count_students'] = Student::whereIn('section_id', $ids)->count();

            //        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
            //        $count_sections =  $ids->count();
            //        $count_students = DB::table('students')->whereIn('section_id',$ids)->count();
            return view('pages.Teachers.dashboard.dashboard', $data);
        });
        Route::get('/teacher/students', [TeacherStudentController::class, 'index'])->name('teacherStudents.index');
        Route::post('/teacher/attendance', [TeacherStudentController::class, 'attendance'])->name('teacher_attendance.store');
    }
);
