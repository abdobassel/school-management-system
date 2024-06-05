<?php

namespace Database\Seeders;

use App\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{

    public function run()
    {
        $grades = [
            ['name' => ['en' => 'Primary Stage', 'ar' => 'المرحلة الابتدائية']],
            ['name' => ['en' => 'Middle stage', 'ar' => 'المرحلة الاعدادية']],
            ['name' => ['en' => 'high school', 'ar' => 'المرحلة الثانوية']],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
