<?php

namespace Database\Seeders;

use App\Models\WorkingDays;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Timeslot;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();
        // Department::factory(5)->create();
        // Patient::factory(5)->create();
        // Doctor::factory(5)->create();
        // WorkingDays::factory(5)->create();
        // Timeslot::factory(5)->create();
        // Appointment::factory(5)->create();
        User::factory(5)->create();
        // Create 5 departments
        Department::factory(5)->create();
        
        
        WorkingDays::factory(5)->create();
        Timeslot::factory(5)->create();
        
       
        // Create appointments, ensuring they are valid
        Appointment::factory(5)->create([
            'doctor_id' => function() {
                return Doctor::all()->random();
            },
            'user_id' => function() {
                return User::all()->random();
            },
            'timeslot_id' => function() {
                return Timeslot::all()->random();
            }
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
