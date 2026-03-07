<?php

namespace Database\Seeders;

use App\Models\Voyage;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoyageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Voyage::factory()->count(10)->create();
    }
}
