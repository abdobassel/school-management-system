<?php

namespace App\Http\Controllers;

use App\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.grades.grades', compact('grades'));
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
        if (Grade::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {
            return redirect()->back()->withErrors(trans('Grades_trans.exists'));
        }
        $grade = new Grade();
        $translations = ['en' => $request->name_en, 'ar' => $request->name_ar];

        $grade->setTranslations('name', $translations);
        $grade->notes = $request->notes;
        $grade->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('grades.index'); // إعادة توجيه المستخدم إلى صفحة العرض الرئيسية
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            //code...

            $grade = Grade::findOrFail($request->id);

            $grade->update([
                $grade->name =  ['en' => $request->name_en, 'ar' => $request->name_ar],
                $grade->notes = $request->notes,
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $grade = Grade::findOrFail($id);


        if ($grade->classrooms()->count() == 0) {
            $grade->delete();
            toastr()->success(trans('messages.success'));
        } else {
            toastr()->error(trans('messages.error_grade_has_classrooms'));
        }

        return redirect()->route('grades.index');
    }
}
