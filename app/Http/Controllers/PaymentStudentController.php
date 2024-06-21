<?php

namespace App\Http\Controllers;

use App\Student;
use App\FundAccount;
use App\PaymentStudent;
use App\StudentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentStudentController extends Controller
{

    public function index()
    {
        $payment_students = PaymentStudent::all();
        return view('pages.students.payment.index', compact('payment_students'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $paymentStudent = new PaymentStudent();

            $paymentStudent->date = date('Y-m-d');
            $paymentStudent->student_id = $request->student_id;
            $paymentStudent->amount = $request->Debit;
            $paymentStudent->desc = $request->description;
            $paymentStudent->save();
            //////////////////////////////////////////////
            $student_acc = new StudentAccount();
            $student_acc->date = date('Y-m-d');
            $student_acc->student_id = $request->student_id;
            $student_acc->payment_id = $paymentStudent->id;
            $student_acc->type = 'payment';
            $student_acc->credit = 0.00;
            $student_acc->debit = $request->Debit; // مدين
            $student_acc->description = $request->description;
            $student_acc->save();

            //////////////////////////////////////////////
            $fundAccount = new FundAccount();
            $fundAccount->date = date('Y-m-d');
            $fundAccount->payment_id = $paymentStudent->id;
            $fundAccount->debit = 00.0;
            $fundAccount->credit = $request->Debit;
            $fundAccount->description = $request->description;
            $fundAccount->save();
            ////////////////////////////


            DB::commit();
            toastr()->success('ok');
            return redirect()->route('payment_student.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.payment.add', compact('student'));
    }

    public function edit($id)
    {
        $payment_student = PaymentStudent::findOrFail($id);
        return view('pages.students.payment.edit', compact('payment_student'));
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $paymentStudent = PaymentStudent::findOrFail($request->id);

            $paymentStudent->date = date('Y-m-d');
            $paymentStudent->student_id = $request->student_id;
            $paymentStudent->amount = $request->Debit;
            $paymentStudent->desc = $request->description;
            $paymentStudent->save();
            //////////////////////////////////////////////
            $student_acc =  StudentAccount::where('payment_id', $request->id);
            $student_acc->date = date('Y-m-d');
            $student_acc->student_id = $request->student_id;
            $student_acc->payment_id = $paymentStudent->id;
            $student_acc->type = 'payment';
            $student_acc->credit = 0.00;
            $student_acc->debit = $request->Debit; // مدين
            $student_acc->description = $request->description;
            $student_acc->save();

            //////////////////////////////////////////////
            $fundAccount =  FundAccount::where('payment_id', $request->id);
            $fundAccount->date = date('Y-m-d');
            $fundAccount->payment_id = $paymentStudent->id;
            $fundAccount->debit = 00.0;
            $fundAccount->credit = $request->Debit;
            $fundAccount->description = $request->description;
            $fundAccount->save();
            ////////////////////////////


            DB::commit();
            toastr()->success('ok Update');
            return redirect()->route('payment_student.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        PaymentStudent::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }
}
