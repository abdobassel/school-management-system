<?php


namespace App\Repository;

use App\Grade;
use App\Subject;
use App\Teacher;
use App\Repository\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::all();
        return view('pages.Subjects.index', compact('subjects'));
    }
    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.subjects.create', compact('teachers', 'grades',));
    }

    public function store($request)
    {
        try {
            $subjects = new Subject();
            $subjects->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('subjects.create');
        } catch (\Exception $e) {
            toastr()->error('Not Success');
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $subject = Subject::findorfail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.subjects.edit', compact('subject', 'grades', 'teachers'));
    }

    public function update($request)
    {
        try {
            $subjects =  Subject::findorfail($request->id);
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('subjects.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $subject = Subject::findOrFail($id);
            $subject->delete();
            toastr()->warning(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
