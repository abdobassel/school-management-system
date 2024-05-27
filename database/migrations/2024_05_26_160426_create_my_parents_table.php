<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Fatherinformation
            $table->string('name_father');
            $table->string('national_id_father');
            $table->string('passport_id_father');
            $table->string('phone_father');
            $table->string('job_father');
            $table->foreignId('nationality_father_id')->constrained('nationalities');
            $table->foreignId('blood_father_id')->constrained('bloods');
            $table->foreignId('religion_father_id')->constrained('religions');
            $table->string('address_father');

            //Mother information
            $table->string('name_mother');
            $table->string('national_id_mother');
            $table->string('passport_id_mother');
            $table->string('phone_Mother');
            $table->string('job_mother');
            $table->foreignId('nationality_mother_id')->constrained('nationalities');
            $table->foreignId('blood_mother_id')->constrained('bloods');
            $table->foreignId('religion_mother_id')->constrained('religions');
            $table->string('address_mother');
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
        Schema::dropIfExists('my_parents');
    }
}
