<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degrees', function (Blueprint $table) {
            $table->id();
            $table->enum('abuse', ['0', '1'])->default('0');
            $table->date('date');
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->float('score');
            $table->foreignId('question_id')->constrained('qusetions')->cascadeOnDelete();
            $table->foreignId('quizze_id')->constrained('quizes')->cascadeOnDelete();
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
        Schema::dropIfExists('degrees');
    }
}
