<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Siege;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservationsSiegeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $reservation = Reservation::inRandomOrder()->first();
        $siege = Siege::where('bus_id', $reservation->voyage->bus_id)
            ->inRandomOrder()
            ->first();

        return [
            'reservation_id' => $reservation->id,
            'siege_id' => $siege->id,
        ];
    }
}
