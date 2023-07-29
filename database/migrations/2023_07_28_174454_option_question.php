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
        Schema::create('option_question', function (Blueprint $table) {
            $table->id('Option_Id');
            $table->foreignId('Question_Id')->constrained('question_quiz', 'Question_Id')->onDelete('cascade');
            $table->string('Option');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_question');
    }
};