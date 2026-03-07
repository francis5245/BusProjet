<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Voyage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $voyage = Voyage::inRandomOrder()->first();
    $nombre_places = fake()->numberBetween(1,4);

    return [
        'user_id' => User::where('role','client')->inRandomOrder()->first()->id,
        'voyage_id' => $voyage->id,
        'nombre_places' => $nombre_places,
        'montant_total' => $voyage->prix * $nombre_places,
        'status' => fake()->randomElement(['en_attente','paye','annule']),
    ];
    }
}
