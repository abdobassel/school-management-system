<?php

namespace App\Http\Controllers;

use App\Gender;
use App\Teacher;
use App\Specialization;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\Repository\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    protected $teacher;
    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }

    public function index()
    {
        $teachers =  $this->teacher->getAllTeachers();

        return view('pages.teachers.Teachers', compact('teachers'));
    }


    public function create()
    {
        $specializations =  $this->teacher->getAllSpecializations();
        $genders = $this->teacher->getAllGender();
        return view('pages.teachers.create', compact('genders', 'specializations'));
    }


    public function store(Request $request)
    {
        return $this->teacher->storeTeachers($request);
    }

    public function show(Teacher $teacher)
    {
        //
    }


    public function edit($id)
    {
        return $this->teacher->editTeacher($id);
    }


    public function update(Request $request)
    {
        return $this->teacher->updateTeacher($request);
    }


    public function destroy(Request $request)
    {
        return $this->teacher->deleteTeachers($request);
    }
}
