<?php

use App\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();

        $specializations = [
            ['ar' => 'اللغة العربية', 'en' => 'Arabic'],
            ['ar' => 'اللغة الانجليزية', 'en' => 'English'],

            ['ar' => 'علوم', 'en' => 'Science'],
            ['ar' => 'حاسب الي ', 'en' => 'Computer'],


        ];

        foreach ($specializations as $s) {
            Specialization::create([
                'name' => $s
            ]);
        }
    }
}
