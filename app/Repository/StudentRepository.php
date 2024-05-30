<?php

namespace App\Repository;

use App\Blood;
use App\Grade;
use App\Gender;
use App\MyParent;
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
    public function store()
    {
    }
    public function edit()
    {
    }
}
