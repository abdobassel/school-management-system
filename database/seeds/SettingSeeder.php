<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();
        $data = [
            ['key' => 'current_session', 'value' => '2024-2025'],
            ['key' => 'school_title', 'value' => 'BasselSchool'],
            ['key' => 'school_name', 'value' => 'Bassel International Schools'],
            ['key' => 'end_first_term', 'value' => '01-12-2024'],
            ['key' => 'end_second_term', 'value' => '01-03-2025'],
            ['key' => 'phone', 'value' => '0100000000'],
            ['key' => 'address', 'value' => 'Cairo'],
            ['key' => 'school_email', 'value' => 'bassel@bassel.com'],
            ['key' => 'logo', 'value' => '1.jpg'],
        ];

        DB::table('settings')->insert($data);
    }
}
