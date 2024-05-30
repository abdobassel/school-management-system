<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Section;
use App\Teacher;
use App\Classroom;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grades = Grade::with('sections')->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Sections.sections', compact('Grades', 'list_Grades', 'teachers'));
    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where('grade_id', $id)->pluck('name', 'id');
        return $list_classes;
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

        $this->validate(
            $request,
            [
                'Name_Section_Ar' => 'required',
                'Name_Section_En' => 'required',
                'Grade_id' => 'required',
                'Class_id' => 'required',
            ],
            [
                'Name_Section_Ar.required' => trans('Sections_trans.required_ar'),
                'Name_Section_En.required' => trans('Sections_trans.required_en'),
                'Grade_id.required' => trans('Sections_trans.Grade_id_required'),
                'Class_id.required' => trans('Sections_trans.Class_id_required'),
            ]
        );



        try {

            $Sections = new Section();
            $Sections->name = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->grade_id = $request->Grade_id;
            $Sections->classroom_id = $request->Class_id;
            $Sections->status = 1;

            $Sections->save();
            // إرفاق المعلمين بعد حفظ القسم لضمان أن معرّف القسم ليس فارغاً
            $Sections->teachers()->attach($request->teacher_id);
            // هنا attach يجب ان تكون بعد حفظ الققسم لضمان الحصول على اي دي قسم 


            toastr()->success(trans('messages.success'));
            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)


    {

        $this->validate(
            $request,
            [
                'Name_Section_Ar' => 'required',
                'Name_Section_En' => 'required',
                'Grade_id' => 'required',
                'Class_id' => 'required',
            ],
            [
                'Name_Section_Ar.required' => trans('Sections_trans.required_ar'),
                'Name_Section_En.required' => trans('Sections_trans.required_en'),
                'Grade_id.required' => trans('Sections_trans.Grade_id_required'),
                'Class_id.required' => trans('Sections_trans.Class_id_required'),
            ]
        );
        try {
            $Sections = Section::findOrFail($request->id);


            $Sections->name = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->grade_id = $request->Grade_id;
            $Sections->classroom_id = $request->Class_id;

            if (isset($request->status)) {
                $Sections->status = 1;
            } else {
                $Sections->status = 2;
            }
            $Sections->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            //throw $th;
            toastr()->error('Didnt Update');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {

        Section::findOrFail($request->id)->delete();
        toastr()->warning(trans('messages.Delete'));
        return redirect()->route('sections.index');
    }
}
