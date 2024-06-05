<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('from_grade')->constrained('grades');
            $table->foreignId('from_Classroom')->constrained('classrooms');
            $table->foreignId('from_section')->constrained('sections');
            $table->foreignId('to_grade')->constrained('grades');
            $table->foreignId('to_Classroom')->constrained('classrooms');
            $table->foreignId('to_section')->constrained('sections');
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
        Schema::dropIfExists('promotions');
    }
}
