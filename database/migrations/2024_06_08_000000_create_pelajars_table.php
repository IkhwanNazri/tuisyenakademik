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
        Schema::create('pelajars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kelas')->nullable();
            $table->string('darjah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelajars');
    }

    // public function up()
    // {
    //     Schema::table('users', function (Blueprint $table) {
    //         $table->string('kelas')->nullable()->change();
    //     });
    //     Schema::table('daftars', function (Blueprint $table) {
    //         $table->string('kelas')->nullable()->change();
    //     });
    //     Schema::table('pelajars', function (Blueprint $table) {
    //         $table->string('kelas')->nullable()->change();
    //     });
    // }

    // public function down()
    // {
    //     Schema::table('users', function (Blueprint $table) {
    //         $table->string('kelas')->nullable(false)->change();
    //     });
    //     Schema::table('daftars', function (Blueprint $table) {
    //         $table->string('kelas')->nullable(false)->change();
    //     });
    //     Schema::table('pelajars', function (Blueprint $table) {
    //         $table->string('kelas')->nullable(false)->change();
    //     });
    // }
}; 