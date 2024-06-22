<?php


namespace App\Repository;

use App\Subject;

class SubjectRepository implements SubjectRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::all();
        return view('pages.Subjects.index', compact('subjects'));
    }
    public function create()
    {
    }

    public function store($request)
    {
    }

    public function edit($id)
    {
    }

    public function update($request)
    {
    }

    public function destroy($request)
    {
    }
}
