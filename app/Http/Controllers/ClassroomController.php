<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $My_Classes = Classroom::with('Grade')->get();
        $Grades = Grade::all();
        return view('pages.My_Classes.My_Classes', compact('My_Classes', 'Grades'));
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
                'List_Classes.*.name' => 'required',
                'List_Classes.*.name_en' => 'required',
                'List_Classes.*.grade_id' => 'required',
            ],
            [
                'List_Classes.*.name.required' => trans('validation.required'),
                'List_Classes.*.name_en.required' => trans('validation.required'),
                'List_Classes.*.grade_id.required' => trans('validation.required'),
            ]
        );

        try {
            // 
            $List_Classes = $request->List_Classes;

            foreach ($List_Classes as $list_class) {
                $My_Classes =  new Classroom();
                $My_Classes->name = ['en' => $list_class['name_en'], 'ar' => $list_class['name']];
                $My_Classes->grade_id = $list_class['grade_id'];
                $My_Classes->save();
            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('Classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $classroom = Classroom::findOrFail($request->id);

            $classroom->update([
                $classroom->name = ['ar' => $request->name, 'en' => $request->name_en],
                $classroom->grade_id = $request->grade_id,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('Classrooms.index');
        } catch (\Exception $e) {
            //throw $th;
            toastr()->error('Didnt Update');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Classroom::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }

    public function deleteAll(Request $request)
    {
        $delete_all_ids = explode(",", $request->delete_all_id);
        // array of ids because seperate ids to array by explode then search in array for id
        // هنا جايلي ايديز من تشيك بوكسس فلازم نفصلهم عن بعض ثم نحذف الجاي فقط في الريكويست 

        Classroom::whereIn('id', $delete_all_ids)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }

    public function filterClasses(Request $request)
    {
        $Grades = Grade::all();
        $search  = Classroom::select('*')->where('grade_id', $request->grade_id)->get();
        return view('pages.My_Classes.My_Classes', compact('Grades'))->withDetails($search);
    }
}
