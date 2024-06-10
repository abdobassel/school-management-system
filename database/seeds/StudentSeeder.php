<?php

use App\Blood;
use App\Grade;
use App\Section;
use App\Student;
use App\MyParent;
use App\Classroom;
use App\Nationality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // حذف جميع السجلات الموجودة في جدول الطلاب
        DB::table('students')->delete();

        // قائمة الطلاب المراد إدخالها
        $students = [
            [
                'name' => ['ar' => 'احمد ابراهيم', 'en' => 'Ahmed Ibrahim'],
                'email' => 'Ahmed_Ibrahim@yahoo.com',
                'password' => Hash::make('12345678'),
                'gender_id' => 1,
                'date_birth' => '2009-01-01',
                'academic_year' => '2021',
            ],
            [
                'name' => ['ar' => 'محمد علي', 'en' => 'Mohamed Ali'],
                'email' => 'mohamed_ali@yahoo.com',
                'password' => Hash::make('12345678'),
                'gender_id' => 1,
                'date_birth' => '2004-01-01',
                'academic_year' => '2021',
            ],
            [
                'name' => ['ar' => 'سارة أحمد', 'en' => 'Sara Ahmed'],
                'email' => 'sara_ahmed@yahoo.com',
                'password' => Hash::make('12345678'),
                'gender_id' => 2,
                'date_birth' => '2009-01-01',
                'academic_year' => '2021',
            ],
            [
                'name' => ['ar' => 'نور الدين', 'en' => 'Nour Eldin'],
                'email' => 'nour_eldin@yahoo.com',
                'password' => Hash::make('12345678'),
                'gender_id' => 1,
                'date_birth' => '2006-01-01',
                'academic_year' => '2021',
            ],
        ];

        // إدخال بيانات الطلاب
        foreach ($students as $studentData) {
            $student = new Student();
            $student->name = $studentData['name'];
            $student->email = $studentData['email'];
            $student->password = $studentData['password'];
            $student->gender_id = $studentData['gender_id'];
            $student->nationalitiy_id = Nationality::all()->unique()->random()->id;
            $student->blood_id = Blood::all()->unique()->random()->id;
            $student->date_birth = $studentData['date_birth'];
            $student->grade_id = Grade::all()->unique()->random()->id;
            $student->classroom_id = Classroom::all()->unique()->random()->id;
            $student->section_id = Section::all()->unique()->random()->id;
            $student->parent_id = MyParent::all()->unique()->random()->id;
            $student->academic_year = $studentData['academic_year'];
            $student->save();
        }
    }
}
