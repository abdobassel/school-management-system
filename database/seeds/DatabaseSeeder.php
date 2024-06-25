<?php

use App\Gender;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GradeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(BloodSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(MyParentSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(SettingSeeder::class);
        // php artisan migrate:fresh --seed
    }
}
