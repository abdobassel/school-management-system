<?php

use App\Grade;
use App\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{

    public function run()
    {
        $grade1 = Grade::where('name->en', 'Primary Stage')->first();
        $grade2 = Grade::where('name->en', 'Middle stage')->first();
        $grade3 = Grade::where('name->en', 'high school')->first();

        $classrooms = [
            ['name' => ['en' => ' First', 'ar' => 'الاول'], 'grade_id' => $grade2->id],
            ['name' => ['en' => 'Second 2', 'ar' => 'الثاني'], 'grade_id' => $grade2->id],
            ['name' => ['en' => 'Third 3', 'ar' => 'الثالث'], 'grade_id' => $grade3->id],
            ['name' => ['en' => 'Fourth', 'ar' => 'الرابع'], 'grade_id' => $grade1->id],
            ['name' => ['en' => 'Fifth', 'ar' => 'الخامس'], 'grade_id' => $grade1->id],
            ['name' => ['en' => 'Six', 'ar' => 'السادس'], 'grade_id' => $grade1->id],

        ];

        foreach ($classrooms as $classroom) {
            Classroom::create($classroom);
        }
    }
}
