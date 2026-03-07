<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Siege;
use Illuminate\Database\Seeder;

class SiegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
           $bus = Bus::all();

    foreach ($bus as $b) {

        for ($i = 1; $i <= $b->nombre_places; $i++) {

            Siege::create([
                'bus_id' => $b->id,
                'numero_siege' => $i
            ]);

        }

    }
    }
}
