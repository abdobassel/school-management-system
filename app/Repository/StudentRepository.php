<?php

namespace App\Repository;

use App\Blood;
use App\Grade;
use App\Gender;
use App\Section;
use App\Student;
use App\MyParent;
use App\Classroom;
use App\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repository\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    public function create()
    {
        $data['genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Blood::all();
        $data['parents'] = MyParent::all();
        $data['grades'] = Grade::all();




        return view('pages.students.add', $data);
    }


    public function getClassesrooms($id)
    {
        $list_classes = Classroom::where('grade_id', $id)->pluck('name', 'id');
        return $list_classes;
    }
    public function getSections($id)
    {

        $lsit_sections = Section::where('classroom_id', $id)->pluck('name', 'id');
        return $lsit_sections;
    }
    public function store($request)
    {
        try {

            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitiy_id = $request->nationality_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->grade_id = $request->Grade_id;
            $students->classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.create');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit()
    {
    }

    // delete 

    public function delete($id)
    {
        try {
            Student::findOrFail($id)->delete();

            toastr()->success(trans('messages.Delete'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    // show

    public function show($id)
    {
        $student = Student::findOrFail($id)->first();
        return view('pages.students.show', compact('student'));
    }
}
