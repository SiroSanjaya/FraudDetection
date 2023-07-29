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
        Schema::create('answare_question', function (Blueprint $table) {
            $table->id('Answare_Id');
            $table->foreignId('Question_Id')->constrained('question_quiz', 'Question_Id')->onDelete('cascade');
            $table->string('Answare');
            $table->tinyInteger('Is_Correct')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answare_question');
    }
};
