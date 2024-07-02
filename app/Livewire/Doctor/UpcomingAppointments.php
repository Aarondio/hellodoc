<?php

namespace App\Livewire\Doctor;

use App\Models\Appointment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.doctor')]
class UpcomingAppointments extends Component
{
    public function render()
    {
       
       
        $appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','=','Confirmed')
        ->get();
        
        return view('livewire.doctor.upcoming-appointments')->with([
            'appointments' => $appointments,
        ]);
    }
}
