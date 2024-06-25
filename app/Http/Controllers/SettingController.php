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


    public function update(Request $request, Setting $setting)
    {
        //
    }
}
