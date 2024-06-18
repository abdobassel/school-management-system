<?php

namespace App\Repository;


interface FeeInvoiceRepositoryInterface
{

    public function store($request);

    public function show($id);

    public function edit($id);
    public function update($request);
    public function index();
    public function destroy($request);
}
