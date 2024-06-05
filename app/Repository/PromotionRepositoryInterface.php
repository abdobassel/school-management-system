<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface PromotionRepositoryInterface
{

    public function index();
    public function store($request);
}
