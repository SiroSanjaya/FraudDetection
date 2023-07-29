<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BisnisUnit extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bisnis_unit')->insert([
            ['Bisnis_Unit_Name' => 'fish'],
            ['Bisnis_Unit_Name' => 'shrimp'],
        ]);
    }
}
