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
        Schema::create('users', function (Blueprint $table) {
            $table->id('User_Id');
            $table->string('name')->index();
            $table->string('email')->unique();
            $table->string('Google_Id');
            $table->enum('role', ['trainer', 'fts', 'admin'])->nullable();
            $table->foreignId('Bisnis_Unit_Id')->nullable()->constrained('bisnis_unit', 'Bisnis_Unit_Id')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
