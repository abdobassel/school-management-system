<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $defaultSettings = [
            'school_name' => '',
            'current_session' => '',
            'school_title' => '',
            'phone' => '',
            'school_email' => '',
            'address' => '',
            'end_first_term' => '',
            'end_second_term' => '',
            'logo' => ''
        ];

        $settingsFromDB = Setting::all()->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        })->toArray();

        $setting = array_merge($defaultSettings, $settingsFromDB);

        return view('pages.settings.index', compact('setting'));
    }




    public function edit(Setting $setting)
    {
        //
    }


    public function update(Request $request)
    {

        try {
            $info = $request->except('_token', '_method', 'logo');
            foreach ($info as $key => $value) {
                Setting::where('key', $key)->update(['value' => $value]);
            }



            if ($request->hasfile('logo')) {

                $file = $request->file('logo');

                $logo_name = $request->file('logo')->getClientOriginalName();
                Setting::where('key', 'logo')->update(['value' => $logo_name]);
                $filePath = public_path('\attachments/logo/' . $logo_name);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $path =   public_path('attachments/logo/' . $logo_name);
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file->move($path, $logo_name);
            }


            toastr()->success(trans('messages.Update'));
            return back();
        } catch (\Exception $e) {

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
