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
        Schema::create('quiz', function (Blueprint $table) {
            $table->id('Quiz_Id');
            $table->foreignId('Courses_Id')->constrained('courses', 'Courses_Id')->onDelete('cascade');
            $table->string('Quiz_Title');
            $table->string('Quiz_Desc');
            $table->dateTime('Quiz_Start')->nullable();
            $table->dateTime('Quiz_End')->nullable();
            $table->enum('Quiz_Status', ['draft', 'progress', 'completed'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz');
    }
};
