<?php


namespace App\Repository;

use App\Fee;
use App\Grade;
use App\Student;
use App\Fee_invoice;
use FeeInvoiceSeeder;
use App\StudentAccount;
use Illuminate\Support\Facades\DB;
use App\Repository\FeeInvoiceRepositoryInterface;

class FeeInvoiceRepository implements FeeInvoiceRepositoryInterface
{

    public function index()
    {
        $fee_invoices = Fee_invoice::all();
        return view('pages.fees_invoices.index', compact('fee_invoices'));
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('classroom_id', $student->classroom_id)->where('grade_id', $student->grade_id)->get();
        return view('pages.fees_invoices.add', compact('fees', 'student'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {

            foreach ($request->List_Fees as $list) {
                $fees = new Fee_invoice();
                $fees->invoice_date = date('Y-m-d');
                $fees->student_id = $list['student_id'];
                $fees->grade_id = $request->grade_id;
                $fees->classroom_id = $request->classroom_id;
                // كلاسرووم وجريد تم اخذهم من الريكويست عشان يفضلو ثابتين لكل الادخالات في الصفحة من نفس الطالب
                $fees->fee_id = $list['fee_id'];
                $fees->amount = $list['amount'];
                $fees->description = $list['description'];
                $fees->save();


                $studentAccount = new StudentAccount();
                $studentAccount->student_id = $list['student_id'];
                $studentAccount->grade_id = $request->grade_id;
                $studentAccount->classroom_id = $request->classroom_id;
                $studentAccount->debit = $list['amount'];
                $studentAccount->credit = 0.00;
                $studentAccount->description = $list['description'];
                $studentAccount->save();
            }

            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('fees_invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
