<?php

namespace App\Http\Controllers;

use App\Fee_invoice;
use Illuminate\Http\Request;
use App\Repository\FeeInvoiceRepositoryInterface;

class FeeInvoiceController extends Controller
{
    protected $feeInvoice;
    public function __construct(FeeInvoiceRepositoryInterface $feeInvoice)
    {
        $this->feeInvoice = $feeInvoice;
    }
    public function index()
    {
        return $this->feeInvoice->index();
    }

    public function show($id)
    {
        return $this->feeInvoice->show($id);
    }


    public function store(Request $request)
    {
        return $this->feeInvoice->store($request);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fee_invoice  $fee_invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->feeInvoice->edit($id);
    }



    public function update(Request $request)
    {
        return $this->feeInvoice->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fee_invoice  $fee_invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->feeInvoice->destroy($request);
    }
}
