<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQusetionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qusetions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quize_id')->constrained('quizes')->cascadeOnDelete();
            $table->string('title', 500);
            $table->string('answers', 500);
            $table->string('right_answer', 500);
            $table->integer('score');
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
        Schema::dropIfExists('qusetions');
    }
}
