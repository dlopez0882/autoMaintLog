<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++) { 
            DB::table('vehicles')->insert([
                'user_id' => 1,
                'year' => rand(1990, 2022),
                'make' => Str::random(10),
                'model' => Str::random(10),
            ]);
        }

    }
}
