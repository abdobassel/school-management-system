<?php

namespace App\Http\Controllers;

use App\Library;
use Illuminate\Http\Request;
use App\Repository\LibraryRepositoryInterface;

class LibraryController extends Controller
{
    protected $library;
    public function __construct(LibraryRepositoryInterface $libraryRepositoryInterface)
    {
        $this->library = $libraryRepositoryInterface;
    }
    public function index()
    {
        return $this->library->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->library->create();
    }


    public function store(Request $request)
    {
        return $this->library->store($request);
    }


    public function show(Library $library)
    {
        //
    }


    public function edit($id)
    {
        return $this->library->edit($id);
    }

    public function update(Request $request)
    {
        return $this->library->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->library->destroy($request);
    }
}
