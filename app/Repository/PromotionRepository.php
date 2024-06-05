<?php

namespace App\Repository;

use App\Grade;
use App\Student;
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

        // steps /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //1 update student table 
        // 2 => student_id => get all student related $reqest->grade-section-classroom => get students

        // $studnts = Student::where('grade_id', $request->Grade_id)->where('classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();
        // new ids => replace old ids -> section_id - classroom_id - grade_id
        //3 => insert to promotions table if not exists - if exists => update
        // more than stuednt => needs foreach => array => inarray(); => ids
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $students = Student::where('grade_id', $request->Grade_id)->where('classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();
        foreach ($students as $student) {
            $ids = explode(',', $student->id);
            $student::whereIn('id', $ids)->update([
                'grade_id' => $request->Grade_id_new,
                'classroom_id' => $request->Classroom_id_new,
                'section_id' => $request->section_id_new
            ]);
        }

        /*
          "Grade_id": "1",
  "Classroom_id": "5",
  "section_id": "6",
  "academic_year": "2025",
  "Grade_id_new": "2",
  "Classroom_id_new": "4",
  "section_id_new": "5",
  "academic_year_new": "2024"
        */
    }
}
