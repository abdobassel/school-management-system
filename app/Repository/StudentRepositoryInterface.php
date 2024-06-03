<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface StudentRepositoryInterface
{

    public function create();
    public function store($request);

    public function edit();
    public function getClassesrooms($id);
    public function getSections($id);
    public function delete($id);
    public function show($id);
    public function upload_attachment($request);
    public function download_attachment($studentName, $filename);
    public function deleteAttachment($request);
}
