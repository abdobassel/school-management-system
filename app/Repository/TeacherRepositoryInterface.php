<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface TeacherRepositoryInterface
{

    public function createTeachers();
    public function getAllTeachers();

    public function getAllGender();
    public function getAllSpecializations();
    public function storeTeachers($request);
}
