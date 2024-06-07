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
        return $request;
    }
}
