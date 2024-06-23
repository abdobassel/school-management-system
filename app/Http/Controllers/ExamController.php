<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
use App\Repository\ExamRepositoryInterface;

class ExamController extends Controller
{
    protected $exam;
    public function __construct(ExamRepositoryInterface $examRepositoryInterface)
    {
        $this->exam = $examRepositoryInterface;
    }
    public function index()
    {
        return $this->exam->index();
    }


    public function create()
    {
        return $this->exam->create();
    }


    public function store(Request $request)
    {
        return $this->exam->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->exam->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->exam->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->exam->destroy($request->id);
    }
}
