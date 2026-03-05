<?php

namespace Database\Seeders;

use App\Models\Bundle;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Bundle::create([
            'name' => 'Starter Bundle',
            'start_time' => Carbon::now(),
            'duration' => '07:00:00', // 7 hours example
            'description' => 'Basic starter bundle.',
            'value' => 1000.00,
            'category_id' => 1,
        ]);

        Bundle::create([
            'name' => 'Silver Bundle',
            'start_time' => Carbon::now(),
            'duration' => '14:00:00', // 14 hours
            'description' => 'Mid-level bundle.',
            'value' => 2500.00,
            'category_id' => 1,
        ]);

        Bundle::create([
            'name' => 'Gold Bundle',
            'start_time' => Carbon::now(),
            'duration' => '24:00:00', // 24 hours
            'description' => 'Premium access bundle.',
            'value' => 5000.00,
            'category_id' => 2,
        ]);
    }
}
