<?php

namespace App\Livewire\Patient;

use App\Models\Appointment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpcomingAppointment extends Component
{
    public function render()
    {
        $appointments = Appointment::where('user_id', Auth::id())
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','=','Confirmed')
        ->get();
        
        return view('livewire.patient.upcoming-appointment')->with([
            'appointments' => $appointments,
        ]);
    }
}
