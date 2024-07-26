<?php

namespace App\Http\Controllers\Api;

use App\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return $grades;
    }

    public function store(Request $request)
    {
        if (Grade::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {
            return response(['msg' => 'name exists'], 400);
        }
        $grade = new Grade();
        $translations = ['en' => $request->name_en, 'ar' => $request->name_ar];

        $grade->setTranslations('name', $translations);
        $grade->notes = $request->notes;
        $grade->save();
        if (!$grade) {
            return response(['nooo errrrrorr']);
        }
        return response()->json([
            'message' => 'Grade Created successfully',
            'data' => $grade,
        ], 201);
    }
    ///
    public function destroy(Request $request)
    {


        $grade = Grade::find($request->id);


        if ($grade && $grade->classrooms()->count() == 0) {
            $grade->delete();
            return response()->json([
                'message' => 'Grade Deleted successfully',

            ], 200);
        } else {

            return response()->json([
                'message' => 'error grade has classrooms or not found grade id',
            ], 400);
        }
    }
}
