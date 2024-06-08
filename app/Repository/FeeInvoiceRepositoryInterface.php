<?php

namespace App\Repository;


interface FeeInvoiceRepositoryInterface
{

    public function store($request);

    public function show($id);
    public function index();
}
