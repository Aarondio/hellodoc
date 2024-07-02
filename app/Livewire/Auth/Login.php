<?php

namespace App\Livewire\Auth;

use Filament\Notifications\Notification;
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

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return;
        }

        Notification::make()
        ->title('Login successful')
        ->color('success')
        ->success()
        ->send();
        // $user = Auth::user();
        // if($user->user_type == 1){
        return redirect()->intended(route('patient-dashboard'));
        // }else{
        //     return redirect()->intended(route('doctor-dashboard'));
        // }

    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
