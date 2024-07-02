<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Timeslot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Generate random appointment time and date
        $date = $this->faker->dateTimeBetween('now', '+1 month');
        $time = $this->faker->time();

        return [
            'doctor_id' => Doctor::factory(), 
            'user_id' => User::factory(), 
            'timeslot_id' => Timeslot::factory(), 
            'appointment_time' => $time,
            'appointment_date' => $date,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['Pending', 'Confirmed', 'Canceled']),
        ];
    }
}
