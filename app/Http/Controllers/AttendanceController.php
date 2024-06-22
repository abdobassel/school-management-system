<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use App\Repository\AttendanceRepositoryInterface;

class AttendanceController extends Controller
{
    protected $attendance;
    public function __construct(AttendanceRepositoryInterface $attendanceRepositoryInterface)
    {
        $this->attendance = $attendanceRepositoryInterface;
    }
    public function index($id)
    {
        return $this->attendance->index($id);
    }
    public function sectionsAttendance()
    {
        return $this->attendance->sectionsAttendance();
    }



    public function store(Request $request)
    {
        return $this->attendance->store($request);
    }


    public function show(Attendance $attendance)
    {
        //
    }

    public function edit(Attendance $attendance)
    {
        //
    }

    public function update(Request $request, Attendance $attendance)
    {
        //
    }


    public function destroy(Attendance $attendance)
    {
        //
    }
}
