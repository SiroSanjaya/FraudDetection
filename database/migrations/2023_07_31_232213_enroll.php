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
        Schema::create('enroll', function (Blueprint $table) {
            $table->id('Enroll_Id');
            $table->foreignId('Enrollment_Id')->constrained('enrollment', 'Enrollment_Id')->onDelete('cascade');
            $table->foreignId('User_Id')->constrained('users', 'User_Id')->onDelete('cascade');
            $table->string('Enroll_Date');
            $table->enum('Enroll_Status',['progress', 'completed'])->default('progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enroll');
    }
};
