<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++) { 
            DB::table('work_items')->insert([
                'service_date' => now()->format('Y-m-d H:i:s'),
                'vehicle_id' => 32,
                'mileage' => rand(30000,100000),
                'services' => Str::random(10),
                'cost' => '100.00',
                'technician' => 'self',
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
