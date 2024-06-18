<?php


namespace App\Repository;

use App\Student;
use App\FundAccount;
use App\ReceiptStudent;
use App\StudentAccount;
use Illuminate\Support\Facades\DB;
use App\Repository\ReceiptStudentRepositoryInterface;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{
    public function index()
    {
        $receipt_students = ReceiptStudent::all();
        return view('pages.students.receipts.index', compact('receipt_students'));
    }
    //////////////////////////////////
    public function edit($id)
    {
        $receipt_student = ReceiptStudent::findOrFail($id);
        return view('pages.students.receipts.edit', compact('receipt_student'));
    }
    ////////////////////////////
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.receipts.add', compact('student'));
    }
    //////////////////////////////////
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $receipt_students = new ReceiptStudent();
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->debit = $request->debit;
            $receipt_students->description = $request->desc;
            $receipt_students->save();

            //
            $fund_account = new FundAccount();
            $fund_account->date = date('Y-m-d');
            $fund_account->receipt_id = $receipt_students->id;
            $fund_account->debit = $request->debit;
            $fund_account->credit = 0.00;
            $fund_account->description = $request->desc;
            $fund_account->save();
            //
            $student_account = new StudentAccount();

            $student_account->date = date('Y-m-d');
            $student_account->type = 'receipt';
            $student_account->student_id = $request->student_id;
            $student_account->receipt_id = $receipt_students->id;
            $student_account->debit = 0.00;
            $student_account->credit = $request->debit;
            $student_account->description =  $request->desc;
            $student_account->save();

            DB::commit();
            toastr()->success(
                trans('messages.success')
            );
            return redirect()->route('receipts_student.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request)
    {
        DB::beginTransaction();
        try {
            $receipt_students =  ReceiptStudent::findOrFail($request->id);
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->debit = $request->Debit;
            $receipt_students->description = $request->desc;
            $receipt_students->save();

            //
            $fund_account =  FundAccount::where('receipt_id', $request->id)->first();
            $fund_account->date = date('Y-m-d');
            $fund_account->receipt_id = $receipt_students->id;
            $fund_account->debit = $request->Debit;
            $fund_account->credit = 0.00;
            $fund_account->description = $request->desc;
            $fund_account->save();
            //
            $student_account =  StudentAccount::where('receipt_id', $request->id)->first();

            $student_account->date = date('Y-m-d');
            $student_account->type = 'receipt';
            $student_account->student_id = $request->student_id;
            $student_account->receipt_id = $receipt_students->id;
            $student_account->debit = 0.00;
            $student_account->credit = $request->Debit;
            $student_account->description =  $request->desc;
            $student_account->save();

            DB::commit();
            toastr()->success(
                trans('messages.Update')
            );
            return redirect()->route('receipts_student.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($request)
    {
        try {
            ReceiptStudent::findOrFail($request->id)->delete();
            toastr()->success(
                trans('messages.Delete')
            );
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
