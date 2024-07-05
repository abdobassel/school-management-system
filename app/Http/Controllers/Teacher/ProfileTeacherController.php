<?php

namespace App\Http\Controllers\Teacher;

use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileTeacherController extends Controller
{

    public function index()
    {
        $information = Teacher::findOrFail(auth()->user()->id);
        return view('pages.teachers.dashboard.profile', compact('information'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        $information_id = $request->info_id;
        $information = Teacher::findorFail($information_id);
        if (!empty($request->password)) {
            $information->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(trans('messages.Update'));
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
