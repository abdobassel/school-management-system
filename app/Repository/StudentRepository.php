<?php

namespace App\Repository;

use App\Blood;
use App\Grade;
use App\Gender;
use App\Section;
use App\MyParent;
use App\Classroom;
use App\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repository\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    public function create()
    {
        $data['genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Blood::all();
        $data['parents'] = MyParent::all();
        $data['grades'] = Grade::all();




        return view('pages.students.add', $data);
    }

    public function getClassesrooms($id)
    {
        $list_classes = Classroom::where('grade_id', $id)->pluck('name', 'id');
        return $list_classes;
    }
    public function getSections($id)
    {

        $lsit_sections = Section::where('classroom_id', $id)->pluck('name', 'id');
        return $lsit_sections;
    }
    public function store()
    {
    }
    public function edit()
    {
    }
}
