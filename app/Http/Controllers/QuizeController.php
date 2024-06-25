<?php

namespace App\Http\Controllers;

use App\Quize;
use Illuminate\Http\Request;
use App\Repository\QuizzRepositoryInterface;

class QuizeController extends Controller
{
    protected $quizze;
    public function __construct(QuizzRepositoryInterface $quizzRepositoryInterface)
    {
        $this->quizze = $quizzRepositoryInterface;
    }
    public function index()
    {
        return $this->quizze->index();
    }


    public function create()
    {
        return $this->quizze->create();
    }


    public function store(Request $request)
    {
        return $this->quizze->store($request);
    }



    public function edit($id)
    {
        return $this->quizze->edit($id);
    }

    public function update(Request $request)
    {
        return $this->quizze->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->quizze->destroy($request);
    }
}
