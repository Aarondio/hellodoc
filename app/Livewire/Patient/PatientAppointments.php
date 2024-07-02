<?php

namespace App\Livewire\Patient;

use App\Models\Appointment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PatientAppointments extends Component
{
    public function render()
    {
        $appointments = Appointment::where('user_id', Auth::id())
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','Pending')
        ->orderBy('appointment_date')
        ->get();

        $p_appointments = Appointment::where('user_id', Auth::id())
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','Pending')
        ->count();

        $u_appointments = Appointment::where('user_id', Auth::id())
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','=','Confirmed')
        ->count();

        $a_appointments = Appointment::where('user_id', Auth::id())
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->orderBy('appointment_date')
        ->where('status','=','Confirmed')
        ->get();

        $c_appointments = Appointment::where('user_id', Auth::id())
        // ->whereDate('appointment_date', '<', Carbon::today())
        // ->where('status','!=','Canceled')
        ->count();

        return view('livewire.patient.patient-appointments')->with([
            'appointments' => $appointments,

            'p_appointments' => $p_appointments,
            'u_appointments' => $u_appointments,
            'c_appointments' => $c_appointments,

            'a_appointments' => $a_appointments,
        ]);
    }
}
