<?php

namespace Database\Factories;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trajet>
 */
class TrajetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ville_depart = Ville::inRandomOrder()->first()->id;
        do {
            $ville_arrivee = Ville::inRandomOrder()->first()->id;
        } while ($ville_arrivee == $ville_depart);

        return [
            'ville_depart_id' => $ville_depart,
            'ville_arrivee_id' => $ville_arrivee,
            'distance' => fake()->numberBetween(50, 600), // km
            'duree' => fake()->numberBetween(1, 12), // heures
        ];
    }
}
