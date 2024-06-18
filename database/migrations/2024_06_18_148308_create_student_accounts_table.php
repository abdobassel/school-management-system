<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            // $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete();
            //$table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('fee_invoice_id')->nullable()->constrained('fee_invoices')->cascadeOnDelete();
            $table->foreignId('receipt_id')->nullable()->constrained('receipt_students')->cascadeOnDelete();
            $table->decimal('debit', 8, 2)->nullable();
            $table->decimal('credit', 8, 2)->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('student_accounts');
    }
}
