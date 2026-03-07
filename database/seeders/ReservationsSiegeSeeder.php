<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ReservationsSiege;
use Illuminate\Database\Seeder;

class ReservationsSiegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ReservationsSiege::factory()->count(5)->create();
    }
}
