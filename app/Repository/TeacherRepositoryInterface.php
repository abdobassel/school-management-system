<?php

namespace App\Repository;

interface TeacherRepositoryInterface
{
    public function getAllTeachers();

    public function getAllGender();
    public function getAllSpecializations();
    public function storeTeachers();
}
