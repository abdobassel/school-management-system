<?php

namespace App\Repository;

use App\Gender;
use App\Teacher;
use App\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repository\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function createTeachers()
    {
    }
    public function storeTeachers($request)
    {
        $request->validate([
            'Email' => 'required|unique:teachers,email|email',
            'Password' => 'required',
            'Name_en' => 'required|string|min:2|max:60',
            'Name_ar' => 'required|string|min:2|max:60',
            'Specialization_id' => 'required',
            'Gender_id' => 'required',
            'Joining_Date' => 'required',
            'Address' => ' required',

        ]);

        try {
            $teacher = new Teacher();
            $teacher->email = $request->Email;
            $teacher->password = Hash::make($request->Password);
            $teacher->name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
            $teacher->specialization_id = $request->Specialization_id;
            $teacher->gender_id = $request->Gender_id;

            $teacher->joined_date = $request->Joining_Date;

            $teacher->adderss = $request->Address;
            $teacher->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('teachers.create');
        } catch (\Exception $e) {
            toastr()->error(trans($e->getMessage()));
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getAllGender()
    {
        return Gender::all();
    }


    public function getAllSpecializations()
    {
        return Specialization::all();
    }


    public function editTeacher($id)
    {
        $teachers = Teacher::findOrFail($id);
        $specializations  = $this->getAllSpecializations();
        $genders = $this->getAllGender();

        return view('pages.teachers.edit', compact('teachers', 'specializations', 'genders'));
    }
    public function updateTeacher($request)

    {
        $request->validate([
            'Email' => 'required|email',
            'Name_en' => 'required|string|min:2|max:60',
            'Name_ar' => 'required|string|min:2|max:60',
            'Specialization_id' => 'required',
            'Gender_id' => 'required',
            'Joining_Date' => 'required',
            'Address' => 'required',
        ]);

        try {

            $teacher = Teacher::findOrFail($request->id);

            $teacher->email = $request->Email;
            $teacher->name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
            $teacher->specialization_id = $request->Specialization_id;
            $teacher->gender_id = $request->Gender_id;

            $teacher->joined_date = $request->Joining_Date;

            $teacher->adderss = $request->Address;
            if ($request->Password) {
                $teacher->password = Hash::make($request->Password);
            }


            $teacher->save();


            toastr()->success(trans('messages.Update'));
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            toastr()->error(trans($e->getMessage()));
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
