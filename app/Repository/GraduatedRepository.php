<?php

namespace App\Repository;

use App\Grade;
use App\Student;
use App\Promotion;
use Illuminate\Support\Facades\DB;
use App\Repository\GraduatedRepositoryInterface;


class GraduatedRepository implements GraduatedRepositoryInterface
{
    public function index()
    {
        $students =  Student::onlyTrashed()->get();
        return view('pages.students.graduated.index', compact('students'));
    }

    // create
    public function create()
    {
        $grades = Grade::all();
        return view('pages.students.graduated.create', compact('grades'));
    }

    public function store($request)
    {
        $students =  Student::where('grade_id', $request->Grade_id)->where('classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();
        if ($students->count() < 1) {
            return redirect()->back()->withErrors(['error' => 'not found ']);
        }
        $studentIds = $students->pluck('id')->toArray();
        Student::whereIn('id', $studentIds)->delete();



        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }
    // retrun student 

    public function returnStudent($request)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->restore();
        toastr()->success(trans('messages.Update'));
        return redirect()->back();
    }

    public function forceDelete($request)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }
}
