<?php

namespace App\Repository;

use App\Grade;
use App\Student;
use App\Promotion;
use Illuminate\Support\Facades\DB;
use App\Repository\PromotionRepositoryInterface;

class PromotionRepository implements PromotionRepositoryInterface
{
    public function index()
    {
        $grades = Grade::all();
        return view('pages.students.promotions.index', compact('grades'));
    }
    public function store($request)
    {
        DB::beginTransaction(); // two tables
        // steps /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //1 update student table 
        // 2 => student_id => get all student related $reqest->grade-section-classroom => get students

        // $studnts = Student::where('grade_id', $request->Grade_id)->where('classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();
        // new ids => replace old ids -> section_id - classroom_id - grade_id
        //3 => insert to promotions table if not exists - if exists => update
        // more than stuednt => needs foreach => array => inarray(); => ids
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        try {
            $students = Student::where('grade_id', $request->Grade_id)->where('classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();

            if ($students->count() < 1) {
                return redirect()->back()->withErrors(['error' => 'Not Found Studnts']);
            }
            foreach ($students as $student) {
                $ids = explode(',', $student->id);
                $student::whereIn('id', $ids)->update([
                    'grade_id' => $request->Grade_id_new,
                    'classroom_id' => $request->Classroom_id_new,
                    'section_id' => $request->section_id_new
                ]);

                Promotion::updateOrCreate([

                    'student_id' => $student->id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_grade' => $request->Grade_id,
                    'from_section' => $request->section_id,

                ], [
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,

                ]);
            }
            DB::commit(); // two tables without errors 
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    // create
    public function create()
    {
        $promotions = Promotion::all();
        return view('pages.students.promotions.management', compact('promotions'));
    }
}
