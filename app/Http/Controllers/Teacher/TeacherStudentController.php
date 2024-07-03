<?php

namespace App\Http\Controllers\Teacher;

use App\Section;
use App\Student;
use App\Teacher;
use App\Classroom;
use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TeacherStudentController extends Controller
{
    public function index()

    {
        //  $ids = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
        $ids = DB::table('section_teacher')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        return view('pages.teachers.dashboard.students', compact('students'));
    }

    public function sections()

    {
        //  $ids = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
        $ids = DB::table('section_teacher')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('section_id', $ids)->get();
        return view('pages.teachers.dashboard.sections', compact('sections'));
    }


    public function attendance(Request $request)
    {
        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::create([
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'sections_id' => $request->section_id,
                    'teacher_id' => 1, //test temp
                    'attendance_date' => date('Y-m-d'),
                    'attendance_status' => $attendence_status
                ]);
            }

            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    ///


}
