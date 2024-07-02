<?php

namespace App\Livewire\Auth\Doctor;


use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function authenticate()
    {
        $this->validate();
        // $credentials = $request->only('email', 'password');
        if (!Auth::guard('doctor')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));
        }
        Notification::make()
            ->title('Login successful')
            ->color('success')
            ->success()
            ->send();
        return redirect()->intended(route('doctor-dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.doctor.login');
    }
}
