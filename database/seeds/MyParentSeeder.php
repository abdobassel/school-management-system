<?php

use App\Blood;
use App\MyParent;
use App\Religion;
use App\Nationality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MyParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my_parents')->delete();
        $my_parents = new MyParent();
        $my_parents->email = 'parent@yahoo.com';
        $my_parents->password = Hash::make('12345678');
        $my_parents->name_father = ['en' => 'emad', 'ar' => 'عماد محمد'];
        $my_parents->national_id_father = '1234567810';
        $my_parents->passport_id_father = '1234567810';
        $my_parents->phone_father = '1234567810';
        $my_parents->job_father = ['en' => 'programmer', 'ar' => 'مبرمج'];
        $my_parents->nationality_father_id = Nationality::all()->unique()->random()->id;
        $my_parents->blood_father_id = Blood::all()->unique()->random()->id;
        $my_parents->religion_father_id = Religion::all()->unique()->random()->id;
        $my_parents->address_father = 'القاهرة';
        $my_parents->name_mother = ['en' => 'SS', 'ar' => 'سس'];
        $my_parents->national_id_mother = '1234567810';
        $my_parents->passport_id_mother = '1234567810';
        $my_parents->Phone_Mother = '1234567810';
        $my_parents->job_mother = ['en' => 'Teacher', 'ar' => 'معلمة'];
        $my_parents->nationality_mother_id = Nationality::all()->unique()->random()->id;
        $my_parents->blood_mother_id = Blood::all()->unique()->random()->id;
        $my_parents->religion_mother_id = Religion::all()->unique()->random()->id;
        $my_parents->address_mother = 'القاهرة';
        $my_parents->save();
    }
}
