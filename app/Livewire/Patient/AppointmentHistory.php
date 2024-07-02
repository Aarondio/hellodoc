<?php

namespace App\Livewire\Patient;

use App\Models\Appointment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class AppointmentHistory extends Component
{
    
    public function render()
    {
        $c_appointments = Appointment::where('user_id', Auth::id())
        // ->whereDate('appointment_date', '<', Carbon::today())
        // ->where('status','!=','Canceled')
        ->get();
        
        return view('livewire.patient.appointment-history')->with([
            'c_appointments' => $c_appointments,
        ]);
    }


}
