<?php

namespace App\Repository;


interface AttendanceRepositoryInterface
{
    public function index($id);

    public function create();

    public function edit($id);

    public function store($request);

    public function update($request);

    public function destroy($request);
    public function sectionsAttendance();
}
