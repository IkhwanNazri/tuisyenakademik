<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daftars', function (Blueprint $table) {
            $table->id();
            // 1.0 Enrollment Information
   
            $table->string('year_intake');
            $table->string('enrollment_start');
 
            
            // 2.0 Student Details
            $table->string('student_name');
            $table->string('mykid');
            $table->string('religion');
            $table->string('race');
            $table->string('gender');
            $table->date('birth_date');
     
            // 3.0 Guardian Info
            $table->string('guardian_first_name');
            $table->string('guardian_last_name');
            $table->string('guardian_ic');
            $table->string('guardian_email');
            $table->string('guardian_relation');
            $table->string('guardian_mobile');
            $table->string('guardian_home')->nullable();
            $table->string('guardian_address');
            $table->string('guardian_occupation')->nullable();
            $table->string('status')->default('pending');
            $table->string('guardian_salary');
            $table->string('guardian_office_address')->nullable();
  
            // 4.0 Spouse Info
     
            // 6.0 How do you know about us
            $table->string('how_know');
            $table->string('kelas');
            $table->string('harga_kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftars');
    }
};
