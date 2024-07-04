<?php

namespace App\Http\Controllers\Teacher;

use App\Grade;
use App\Quize;
use App\Section;
use App\Subject;
use App\Classroom;
use App\QuesetionQ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizeTeacherController extends Controller
{

    public function index()
    {
        $quizzes = Quize::where('teacher_id', auth()->user()->id)->get();
        return view('pages.teachers.quizzes.index', compact('quizzes'));
    }


    public function show($id)
    {
        $quizze = Quize::findOrFail($id);
        $questions = QuesetionQ::where('quize_id', $id)->get();
        return $questions;
        // return view('pages.teachers.quizzes.index', compact('quizzes'));
    }


    public function create()
    {
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();
        $grades = Grade::all();
        //  return $subjects;
        return view('pages.teachers.quizzes.create', compact('grades', 'subjects'));
    }


    public function store(Request $request)
    {
        try {

            $quizzes = new Quize();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = auth()->user()->id;
            $quizzes->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('quizesTeacher.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $quizz = Quize::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id', auth()->user()->id)->get();

        return view('pages.teachers.quizzes.edit', $data, compact('quizz'));
    }

    public function update(Request $request)
    {
        try {
            $quizz = Quize::findorFail($request->id);
            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('quizesTeacher.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            Quize::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    ////
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
}
