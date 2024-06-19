<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GradutedController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\FeeInvoiceController;
use App\Http\Controllers\ProcessingFeesController;
use App\Http\Controllers\ReceiptStudentController;
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
        Route::delete('/teachers', [TeacherController::class, 'destroy'])->name('teachers.destroy');

        //students
        Route::get('/students', [StudentController::class, 'index'])->name('students.index');

        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/students/create', [StudentController::class, 'store'])->name('students.store');

        Route::delete('/students', [StudentController::class, 'destroy'])->name('students.destroy');
        Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
        // upload
        Route::post('upload_attachment', [StudentController::class, 'upload_attachment'])->name('students.upload_attachment');
        // dwonload
        Route::get('download_attachment/{studentname}/{filename}', [StudentController::class, 'download_attachment'])->name('students.download_attachment');
        // delete attachment
        Route::post('delete_attachment', [StudentController::class, 'deleteAttachment'])->name('students.delete_attachment');
        // promotion students 
        Route::get('/promotions', [PromotionController::class, 'index'])->name('students.promotions.index');

        Route::post('/promotions', [PromotionController::class, 'store'])->name('students.promotions.store');
        Route::get('/promotions-management', [PromotionController::class, 'create'])->name('students.promotions.create');
        Route::delete('/promotions', [PromotionController::class, 'destroy'])->name('students.promotions.destroy');
        // graduated
        Route::get('/graduated', [GradutedController::class, 'index'])->name('graduted.index');
        Route::get('/graduated/create', [GradutedController::class, 'create'])->name('graduted.create');
        Route::post('/graduated/create', [GradutedController::class, 'store'])->name('graduated.store');
        Route::put('/graduated', [GradutedController::class, 'returnStudent'])->name('graduated.restore');

        Route::delete('/graduated', [GradutedController::class, 'forceDelete'])->name('graduated.forceDelete');

        // fees 
        Route::get('/fees', [FeeController::class, 'index'])->name('fees.index');
        Route::get('/fees/create', [FeeController::class, 'create'])->name('fees.create');
        Route::post('/fees/create', [FeeController::class, 'store'])->name('fees.store');
        Route::get('/fees/{fee_id}', [FeeController::class, 'edit'])->name('fees.edit');
        Route::put('/fees/update', [FeeController::class, 'update'])->name('fees.update');
        Route::get('/fees/students/{id}', [FeeController::class, 'showStudentsTableFees'])->name('fees.showStudentsTableFees');
        // fees invoices
        Route::get('/fees-invoice', [FeeInvoiceController::class, 'index'])->name('fees_invoices.index');



        Route::get('/fees-invoice/{id}', [FeeInvoiceController::class, 'edit'])->name('fees_invoices.edit');
        Route::post('/fees-invoices', [FeeInvoiceController::class, 'store'])->name('fees_invoices.store');

        Route::post('/fees-invoice', [FeeInvoiceController::class, 'destroy'])->name('fees_invoices.delete');
        Route::put('/fees-invoice', [FeeInvoiceController::class, 'update'])->name('fees_invoices.update');
        Route::get('/fees-invoice/{id}', [FeeInvoiceController::class, 'show'])->name('fees_invoices.show');
        // receipts 
        Route::get('/receipt_student', [ReceiptStudentController::class, 'index'])->name('receipts_student.index');

        Route::get('/receipt_students/{id}', [ReceiptStudentController::class, 'show'])->name('receipts_student.show');
        Route::post('/receipt_student', [ReceiptStudentController::class, 'store'])->name('receipts_student.store');
        Route::get('/receipt_student/{id}', [ReceiptStudentController::class, 'edit'])->name('receipts_student.edit');
        Route::put('/receipt_student', [ReceiptStudentController::class, 'update'])->name('receipts_student.update');
        Route::delete('/receipt_student', [ReceiptStudentController::class, 'destroy'])->name('receipts_student.destroy');
        // processing 
        Route::get('/processing_fees/{id}', [ProcessingFeesController::class, 'show'])->name('processing_fees.show');
        Route::get('/processing_fees', [ProcessingFeesController::class, 'index'])->name('processing_fees.index');

        Route::post('/processing_fees', [ProcessingFeesController::class, 'store'])->name('processing_fees.store');
        Route::get('/processing_fees_edit/{id}', [ProcessingFeesController::class, 'edit'])->name('processing_fees.edit');
        Route::put('/processing_fees', [ProcessingFeesController::class, 'update'])->name('processing_fees.update');










        // options select class and grades and sections

        Route::get('/Get_classrooms/{id}', [StudentController::class, 'getClassesrooms']);
        Route::get('/Get_Sections/{id}', [StudentController::class, 'getSections']);


        // Route::get('/teachers/edit/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
        //Route::patch('/teachers/update', [TeacherController::class, 'update'])->name('teachers.update');
        //Route::delete('/teachers', [TeacherController::class, 'destroy'])->name('teachers.destroy');


    }

);
Route::get('/test', function () {
    return view('test');
});
