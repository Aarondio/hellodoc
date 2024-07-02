<?php

namespace App\Livewire\Doctor;

use App\Models\Appointment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.doctor')]
class AppointmentsHistory extends Component
{
    public function render()
    {
        $c_appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
        // ->whereDate('appointment_date', '<', Carbon::today())
        // ->where('status','!=','Canceled')
        ->orderBy('created_at', 'DESC')
        ->get();
        
        return view('livewire.doctor.appointments-history')->with([
            'c_appointments' => $c_appointments,
        ]);
     
    }
}
