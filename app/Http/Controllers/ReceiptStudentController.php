<?php

namespace App\Http\Controllers;

use App\ReceiptStudent;
use Illuminate\Http\Request;
use App\Repository\ReceiptStudentRepositoryInterface;

class ReceiptStudentController extends Controller
{
    protected $receipt;
    public function __construct(ReceiptStudentRepositoryInterface $receiptStudent)
    {
        $this->receipt = $receiptStudent;
    }
    ///////////////////////////////////
    public function index()
    {
        return $this->receipt->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->receipt->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReceiptStudent  $receiptStudent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->receipt->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReceiptStudent  $receiptStudent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->receipt->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReceiptStudent  $receiptStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->receipt->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReceiptStudent  $receiptStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->receipt->delete($request);
    }
}
