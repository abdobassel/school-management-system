<?php

namespace App\Http\Controllers;

use App\Student;
use App\ProcessingFees;
use App\StudentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessingFeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processingFees = ProcessingFees::all();

        return view('pages.students.processing_fees.index', compact('processingFees'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $processingFees = new ProcessingFees();

            $processingFees->date = date('Y-m-d');
            $processingFees->student_id = $request->student_id;
            $processingFees->amount = $request->Debit;
            $processingFees->desc = $request->description;
            $processingFees->save();
            //////////////////////////////////////////////
            $student_acc = new StudentAccount();
            $student_acc->date = date('Y-m-d');
            $student_acc->student_id = $request->student_id;
            $student_acc->processing_id = $processingFees->id;
            $student_acc->type = 'processing_fee';
            $student_acc->credit = $request->Debit;
            $student_acc->debit = 0.00; // داين
            $student_acc->description = $request->description;
            $student_acc->save();

            //////////////////////////////////////////////
            DB::commit();
            toastr()->success('ok');
            return redirect()->route('processing_fees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProcessingFees  $processingFees
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.processing_fees.add', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProcessingFees  $processingFees
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcessingFees $processingFees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProcessingFees  $processingFees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcessingFees $processingFees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProcessingFees  $processingFees
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcessingFees $processingFees)
    {
        //
    }
}
