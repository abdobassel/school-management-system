<?php

namespace App\Http\Controllers;

use App\Grade;
use Illuminate\Http\Request;
use App\Repository\GraduatedRepositoryInterface;

class GradutedController extends Controller
{

    protected $graduated;

    public function __construct(GraduatedRepositoryInterface $graduated)
    {
        $this->graduated = $graduated;
    }

    public function index()
    {
        return $this->graduated->index();
    }

    public function create()
    {
        return $this->graduated->create();
    }
    public function store(Request $request)
    {
        return $this->graduated->store($request);
    }
    public function returnStudent(Request $request)
    {
        return $this->graduated->returnStudent($request);
    }
    public function forceDelete(Request $request)
    {
        return $this->graduated->forceDelete($request);
    }
}
