<?php

namespace App\Livewire\Doctor;

use App\Models\Appointment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.doctor')]
class Appointments extends Component
{
    public function render()
    {
       

        $p_appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','Pending')
        ->count();

        $u_appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','=','Confirmed')
        ->count();

        $c_appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
        // ->whereDate('appointment_date', '<', Carbon::today())
        // ->where('status','!=','Canceled')
        ->count();

        $a_appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->orderBy('appointment_date')
        ->where('status','=','Confirmed')
        ->get();

        $appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','Pending')
        ->orderBy('appointment_date')
        ->get();

      
        return view('livewire.doctor.appointments')->with([
            'appointments' => $appointments,

            'p_appointments' => $p_appointments,
            'u_appointments' => $u_appointments,
            'c_appointments' => $c_appointments,

            'a_appointments' => $a_appointments,
        ]);
    }
}
