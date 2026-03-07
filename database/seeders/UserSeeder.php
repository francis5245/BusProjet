<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // User::factory()->count(20)->create();
         User::create([
        'name' => 'Francis',
        'email' => 'francissagbo1@gmail.com',
        'phone' => '97000000',
        'role' => 'client',
        'password' => Hash::make('123456789'),
    ]);

    User::create([
        'name' => 'Sebastien',
        'email' => 'sebastiensagbo1@gmail.com',
        'phone' => '97000001',
        'role' => 'admin',
        'password' => Hash::make('123456789'),
    ]);

    User::create([
        'name' => 'Chegun',
        'email' => 'chegun8@gmail.com',
        'phone' => '97000002',
        'role' => 'chauffeur',
        'password' => Hash::make('123456789'),
    ]);
    }
}
