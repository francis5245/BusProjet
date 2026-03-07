<?php

namespace Database\Seeders;

use App\Models\Trajet;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrajetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
          Trajet::factory()->count(10)->create();
    }
}
