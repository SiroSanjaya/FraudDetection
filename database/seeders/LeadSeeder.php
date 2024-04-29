<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    try {
        for ($i = 0; $i < 20; $i++) {
            DB::table('leads')->insert([
                'first_name' => 'Test',
                'last_name' => 'Lead 00'.rand(0,999),
                'email' => Str::random(10) . '@example.com',
                'phone_number' => '08'.rand(1000000000, 9999999999),
                'kota' => 'City ' . $i,
                'provinsi' => 'Province ' . $i,
                'address' => Str::random(20),
                'NIK' => rand(1000000000, 9999999999),
                'NPWP' => rand(1000000000, 9999999999),
                'status' => Arr::random(['open', 'contacted']),
                'source' => 'Web',
                'score' => rand(34, 70),
                'created_by' => 5, // Assuming you have a user with ID 1
                'unqualifiedReason' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    } catch (\Exception $e) {
        Log::error('Failed to seed leads: ' . $e->getMessage());
    }
}

}
