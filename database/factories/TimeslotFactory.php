<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timeslot>
 */
class TimeslotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Generate random start and end times within a day
        $start = $this->faker->dateTimeBetween('now', '+1 week');
        $end = (clone $start)->modify('+1 hour'); // Assuming a 1-hour timeslot

        return [
            'doctor_id' => Doctor::factory(), // Create a related doctor
            'start_time' => $start,
            'end_time' => $end,
        ];
    }
}
