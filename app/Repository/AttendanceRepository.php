<?php


namespace App\Repository;

use App\Grade;
use App\Student;
use App\Teacher;
use App\Attendance;
use App\Repository\AttendanceRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function index($id)
    {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        return view('pages.attendance.index', compact('students'));
    }

    public function sectionsAttendance()
    {
        $grades = Grade::with(['sections'])->get();
        $list_grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.attendance.sections', compact('grades', 'list_grades', 'teachers'));
    }

    public function create()
    {
    }

    public function edit($id)
    {
    }

    public function store($request)
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

    public function update($request)
    {
    }

    public function destroy($request)
    {
    }
}
