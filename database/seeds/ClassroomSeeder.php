<?php

use App\Grade;
use App\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{

    public function run()
    {

        DB::table('classrooms')->delete();

        $classrooms = [
            ['name' => ['en' => ' First', 'ar' => 'الاول']],
            ['name' => ['en' => 'Second 2', 'ar' => 'الثاني']],
            ['name' => ['en' => 'Third 3', 'ar' => 'الثالث']],
            ['name' => ['en' => 'Fourth', 'ar' => 'الرابع']],
            ['name' => ['en' => 'Fifth', 'ar' => 'الخامس']],
            ['name' => ['en' => 'Six', 'ar' => 'السادس']],

        ];

        foreach ($classrooms as $classroom) {
            Classroom::create([
                'name' => $classroom,
                'grade_id' => Grade::all()->unique()->random()->id
            ]);
        }
    }
}
