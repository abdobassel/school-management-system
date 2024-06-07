<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface GraduatedRepositoryInterface
{

    public function index();
    public function store($request);
    public function create();
}
