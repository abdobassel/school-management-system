<?php

namespace App\Repository;

use App\Teacher;
use App\Repository\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getAllGender()
    {
    }
    public function getAllSpecializations()
    {
    }
    public function storeTeachers()
    {
    }
}
