<?php

namespace App\Repository;


interface ReceiptStudentRepositoryInterface
{
    public function index();
    public function edit($id);
    public function show($id);
    public function store($request);
    public function update($request);
    public function delete($request);
}
