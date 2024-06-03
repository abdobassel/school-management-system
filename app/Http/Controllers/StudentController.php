<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentsRequest;
use App\Repository\StudentRepositoryInterface;

class StudentController extends Controller
{
    protected $student;
    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        $students =  Student::all();

        return view('pages.students.students', compact('students'));
    }
    ////// upload attachment student 
    public function  upload_attachment(Request $request)
    {
        return $this->student->upload_attachment($request);
    }
    public function download_attachment($studentName, $filename)
    {
        return $this->student->download_attachment($studentName, $filename);
    }
    // delete attachment
    public function deleteAttachment(Request $request)
    {
        return $this->student->deleteAttachment($request);
    }

    public function create()
    {
        return $this->student->create();
    }
    ///////// with ajax code in footer scripts file ////////
    public function getClassesrooms($id)
    {
        return $this->student->getClassesrooms($id);
    }

    public function getSections($id)
    {
        return $this->student->getSections($id);
    }
    ////////////////////////////////////////////////////////

    public function store(StoreStudentsRequest $request)
    {
        return $this->student->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   /////// test /////////////
        // $data = [];
        // $data['student'] = $this->student->show($id);
        // $data['status'] = 'success';
        // return $data;
        ////////////////////////////////
        return $this->student->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->student->delete($request->id);
    }
}
