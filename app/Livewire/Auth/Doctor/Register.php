<?php

namespace App\Livewire\Auth\Doctor;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use App\Models\WorkingDays;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class Register extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $school_attended = '';

    /** @var Integer */
    public $department_id = '';

    /** @var string */
    public $passwordConfirmation = '';

    public function register()
    {
        $this->validate([
            'name' => ['required'],
            'department_id' => ['required'],
            // 'school_attended' => ['required'],
            'email' => ['required', 'email', 'unique:doctors'],
            'password' => ['required', 'min:6', 'same:passwordConfirmation'],
        ]);

       
        $user = Doctor::create([
            'name' => $this->name,
            'email' => $this->email,
            'department_id'=>$this->department_id,
            'password' =>$this->password,
        ]);

        $workingDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday','Sunday'];
        foreach ($workingDays as $day) {
            WorkingDays::create([
                'doctor_id' => $user->id,
                'day' => $day,
                'is_working' => true,
            ]);
        }

        event(new Registered($user));

        Auth::guard('doctor')->login($user, true);

        return redirect()->intended(route('doctor-dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.doctor.register')->with([
            'departments'=>Department::where('is_active',1)->get()
        ]);
    }
}
