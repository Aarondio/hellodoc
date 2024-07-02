<?php

namespace App\Livewire\Doctor;

use App\Models\Appointment;
use App\Models\WorkingDays;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.doctor')]
class DoctorDashboard extends Component
{
    public function render()
    {

        $workingDays = WorkingDays::where('doctor_id', Auth::guard('doctor')->user()->id)
            ->where('is_working', 1)
            ->get();

        // $appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)->get();
        $appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
            ->whereDate('appointment_date', '>=', Carbon::today())
            ->where('status', '!=', 'Canceled')
            ->orderBy('appointment_date')
            ->get();

        $p_appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
            ->whereDate('appointment_date', '>=', Carbon::today())
            ->where('status', 'Pending')
            ->count();

        $u_appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
            ->whereDate('appointment_date', '>=', Carbon::today())
            ->where('status', '=', 'Confirmed')
            ->count();

        $c_appointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
            // ->whereDate('appointment_date', '<', Carbon::today())
            // ->where('status','!=','Canceled')
            ->count();

        $pendingappointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
            ->whereDate('appointment_date', '>=', Carbon::today())
            ->where('status', 'Pending')
            ->get();
        $approvedappointments = Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
            ->whereDate('appointment_date', '>=', Carbon::today())
            ->where('status', 'Confirmed')
            ->get();

        return view('livewire.doctor.doctor-dashboard')->with([
            'days' => $workingDays,
            'appointments' => $appointments,
            'p_appointments' => $p_appointments,
            'u_appointments' => $u_appointments,
            'c_appointments' => $c_appointments,
            'pendingappointments' => $pendingappointments,
            'approvedappointments' => $approvedappointments,


        ]);
    }
}
