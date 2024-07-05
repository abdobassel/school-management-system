<?php

namespace App\Http\Controllers\Student;

use App\Quize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamStudentrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quize::where('grade_id', auth()->user()->grade_id)
            ->where('section_id', auth()->user()->section_id)
            ->where('classroom_id', auth()->user()->classroom_id)
            ->orderBy('id', 'DESC')->get();

        return view('pages.students.exams.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($quizze_id)
    {

        $student_id = auth()->user()->id;
        return view('pages.students.exams.show', compact('quizze_id', 'student_id'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
