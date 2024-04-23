<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoreToLeadsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            // Add a new column 'score' with type integer and default value as 0
            $table->integer('score')->default(0)->comment('Lead score between 0 and 100');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            // Remove the 'score' column if this migration is rolled back
            $table->dropColumn('score');
        });
    }
}
