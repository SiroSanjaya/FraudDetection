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
        Schema::create('enrollment', function (Blueprint $table) {
            $table->id('Enrollment_Id');
            $table->string('Enrollment_Title');
            $table->string('Enrollment_Desc');
            $table->foreignId('Category_Courses_Id')->constrained('category_courses', 'Category_Id')->onDelete('cascade');
            $table->string('Enrollment_Start');
            $table->string('Enrollment_End');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment');
    }
};
