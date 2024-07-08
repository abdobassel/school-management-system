<?php

use App\Student;
use App\Teacher;
use LDAP\Result;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\QuizeTeacherController;
use App\Http\Controllers\Teacher\ProfileTeacherController;
use App\Http\Controllers\Teacher\TeacherStudentController;
use App\Http\Controllers\Teacher\QuestionsTeacherController;
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

        // quize
        Route::get('/teacher/quizes', [QuizeTeacherController::class, 'index'])->name('quizesTeacher.index');
        Route::get('/teacher/quizes/create', [QuizeTeacherController::class, 'create'])->name('quizesTeacher.create');

        Route::post('/teacher/quizes', [QuizeTeacherController::class, 'store'])->name('quizesTeacher.store');
        Route::get('/teacher/quizes/edit/{id}', [QuizeTeacherController::class, 'edit'])->name('quizzerTeacher.edit');
        Route::put('/teacher/quizes', [QuizeTeacherController::class, 'update'])->name('quizesTeacher.update');
        Route::delete('/teacher/quizes', [QuizeTeacherController::class, 'destroy'])->name('quizesTeacher.destroy');
        //show questions quize_id
        Route::get('/teacher/quizes_questions/{quize_id}', [QuizeTeacherController::class, 'show'])->name('quizesTeacher.show');
        // show students quizze -> fineshed quize

        Route::get('/teacher/quizes_students/{quize_id}', [QuizeTeacherController::class, 'studentsQuizzeShow'])->name('studentsQuizzeTeacher.show');

        /// create question
        Route::get('/teacher/questions/{quize_id}', [QuestionsTeacherController::class, 'show'])->name('questionTeacher.show');
        Route::post('/teacher/questions/', [QuestionsTeacherController::class, 'store'])->name('questionTeacher.store');
        Route::get('/teacher/questions/{id}/edit', [QuestionsTeacherController::class, 'edit'])->name('questionTeacher.edit');
        Route::put('/teacher/question/', [QuestionsTeacherController::class, 'update'])->name('questionTeacher.update');
        Route::delete('/teacher/questions/{id}', [QuestionsTeacherController::class, 'destroy'])->name('questionTeacher.destroy');
        //profile
        Route::get('teacher/profile', [ProfileTeacherController::class, 'index'])->name('profileTeacher.index');

        Route::put('teacher/profile', [ProfileTeacherController::class, 'update'])->name('profileTeacher.update');




        ////
        Route::get('/Get_classrooms/{id}', [QuizeTeacherController::class, 'getClassesrooms']);
        Route::get('/Get_Sections/{id}', [QuizeTeacherController::class, 'getSections']);
    }
);
