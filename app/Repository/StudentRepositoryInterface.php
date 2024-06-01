<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface StudentRepositoryInterface
{

    public function create();
    public function store();
    public function edit();
    public function getClassesrooms($id);
    public function getSections($id);
}
