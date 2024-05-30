<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('gender_id')->constrained('genders');
            $table->foreignId('nationalitiy_id')->constrained('nationalities');
            $table->foreignId('blood_id')->constrained('bloods');
            $table->date('Date_Birth');
            $table->foreignId('grade_id')->constrained('grades');
            $table->foreignId('classroom_id')->constrained('classrooms');
            $table->foreignId('section_id')->constrained('sections');
            $table->foreignId('parent_id')->constrained('my_parents');
            $table->string('academic_year');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
