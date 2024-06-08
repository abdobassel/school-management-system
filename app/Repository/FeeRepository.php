<?php


namespace App\Repository;

use App\Fee;
use App\Grade;
use App\Repository\FeeRepositoryInterface;

class FeeRepository implements FeeRepositoryInterface
{
    public function index()
    {
        $fees = Fee::all();
        return view('pages.fees.index', compact('fees'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.fees.add', compact('grades'));
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        $grades = Grade::all();
        return view('pages.fees.edit', compact('fee', 'grades'));
    }

    public function store($request)
    {
        try {
            $fee = new Fee();

            $fee->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $fee->description = $request->description;
            $fee->amount = $request->amount;
            $fee->classroom_id = $request->Classroom_id;

            $fee->grade_id = $request->Grade_id;
            $fee->year = $request->year;
            $fee->fee_type = $request->Fee_type;
            $fee->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('fees.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {
            $fee = Fee::findOrFail($request->id);

            $fee->title = ['ar' => $request->title_ar, 'en' => $request->title_en];
            $fee->description = $request->description;
            $fee->amount = $request->amount;
            $fee->classroom_id = $request->Classroom_id;

            $fee->grade_id = $request->Grade_id;
            $fee->year = $request->year;
            //  $fee->fee_type = $request->Fee_type;
            $fee->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('fees.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
    }
}
