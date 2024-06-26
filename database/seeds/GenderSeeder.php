<?php

use App\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();

        $genders = [
            ['ar' => 'ذكر', 'en' => 'Male'],
            ['ar' => 'أنثى', 'en' => 'Female']
        ];

        foreach ($genders as $gender) {
            Gender::create([
                'name' => $gender
            ]);
        }
    }
}
