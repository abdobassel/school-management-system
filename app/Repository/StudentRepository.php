<?php

namespace App\Repository;

use App\Blood;
use App\Grade;
use App\Image;
use App\Gender;
use App\Section;
use App\Student;
use App\MyParent;
use App\Classroom;
use App\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction(); // هنا يوجد جدولين يجب ان يكونا بدون مشاكل ليتم الحفظ
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
            // photos 
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $path =   public_path('attachments/students/' . $request->name_en);
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    $file->move($path, $name);


                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_type = 'App\Student';
                    $images->imageable_id = $students->id;
                    $images->save();
                }
            }
            DB::commit(); // اذا كان الجدولين تمام من غير مشاكل

            toastr()->success(trans('messages.success'));
            return redirect()->route('students.create');
        } catch (\Exception $e) {
            DB::rollback(); // حذف البيانات من الداتا بيز لو وجدت اخطاء 
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit()
    {
    }
    public function  upload_attachment($request)
    {

        try {
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $path =   public_path('attachments/students/' . $request->student_name); //from show blade 
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    $file->move($path, $name);


                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_type = 'App\Student';
                    $images->imageable_id = $request->student_id;
                    $images->save();
                }
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.show', $request->student_id);
        } catch (\Exception $e) {
            toastr()->error(['error' => $e->getMessage()]);
        }
    }

    // download 
    public function download_attachment($studentName, $filename)
    {
        return response()->download(public_path('attachments/students/' . $studentName . '/' . $filename));
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
    // delete attachment
    public function deleteAttachment($request)
    {
        $image = Image::findOrFail($request->id);

        // حدد المسار الكامل للصورة على السيرفر
        $studentName = $request->student_name;
        $filePath = public_path('\attachments/students/' . $studentName . '/' . $image->filename);
        // \ => بتفرق

        // حذف الصورة من قاعدة البيانات
        $image->delete();

        // تحقق من وجود الملف واحذفه
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }
    // show

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.show', compact('student'));
    }
}
