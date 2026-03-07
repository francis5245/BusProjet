<?php

namespace Database\Factories;

use App\Models\Bus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SiegeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bus = Bus::inRandomOrder()->first();

        return [
            'bus_id' => $bus->id,
            'numero_siege' => fake()->numberBetween(1, $bus->nombre_places),
        ];
    }
}
