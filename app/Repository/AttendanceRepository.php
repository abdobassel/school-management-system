<?php


namespace App\Repository;

use App\Student;
use App\Repository\AttendanceRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function index()
    {
        $students = Student::all();
        return view('pages.attendance.index', compact('students'));
    }

    public function create()
    {
    }

    public function edit($id)
    {
    }

    public function store($request)
    {
        return $request;
    }

    public function update($request)
    {
    }

    public function destroy($request)
    {
    }
}
