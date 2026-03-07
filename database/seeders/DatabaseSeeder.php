<?php

namespace Database\Seeders;

// use App\Models\User;

// use App\Models\ReservationSiege;
// use App\Models\Siege;
use Database\Seeders\ReservationsSiegeSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call([
        //     AdminUserSeeder::class,
        // ]);
        $this->call([
            VilleSeeder::class,
            BusSeeder::class,
            // UserSeeder::class,
            
        ]);
         $this->call(UserSeeder::class);
        $this->call(TrajetSeeder::class);
          $this->call(VoyageSeeder::class);
        $this->call(SiegeSeeder::class);
        $this->call(ReservationSeeder::class);
         $this->call(ReservationsSiegeSeeder::class);
    }
}
