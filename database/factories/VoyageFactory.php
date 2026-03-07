<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VoyageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trajet_id' => Trajet::inRandomOrder()->first()->id,
            'bus_id' => Bus::inRandomOrder()->first()->id,
            'chauffeur_id' => User::where('role', 'chauffeur')->inRandomOrder()->first()->id,
            'date_depart' => fake()->dateTimeBetween('now', '+1 month'),
            'heure_depart' => fake()->time(),
            'prix' => fake()->numberBetween(3000, 20000),
            'places_disponibles' => fake()->numberBetween(20, 60),
            'status' => fake()->randomElement(['ouvert', 'complet', 'annule']),
        ];
    }
}
