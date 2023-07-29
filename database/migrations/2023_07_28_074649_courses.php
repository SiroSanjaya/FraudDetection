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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('Courses_Id');
            $table->foreignId('Category_Id')->nullable()->constrained('category_courses', 'Category_Id')->onDelete('cascade');
            $table->string('Courses_Title');
            $table->string('Courses_Desc');
            $table->string('Courses_Module');
            $table->string('Courses_Image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
