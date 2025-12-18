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
       Schema::create('pelamar', function (Blueprint $table) {
    $table->increments('pelamar_id'); 
    
    $table->string('first_name', 100);
    $table->string('last_name', 100);
    $table->date('birthday')->nullable();
    $table->enum('gender', ['Male', 'Female', 'Other']);
    $table->string('email')->unique();
    $table->string('phone', 20)->nullable();
    $table->string('posisi_dilamar')->nullable(); 
    $table->string('cv_file')->nullable(); 
    $table->enum('status', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
    
    $table->timestamps(); 
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamar');
    }
};
