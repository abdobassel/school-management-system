<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use App\Repository\SubjectRepositoryInterface;

class SubjectController extends Controller
{
    protected $subject;
    public function __construct(SubjectRepositoryInterface $subject)
    {
        $this->subject = $subject;
    }


    public function index()
    {
        return $this->subject->index();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Subject $subject)
    {
        //
    }

    public function edit(Subject $subject)
    {
        //
    }


    public function update(Request $request, Subject $subject)
    {
        //
    }


    public function destroy(Subject $subject)
    {
        //
    }
}
