<?php

namespace App\Livewire\Patient;

use App\Models\Appointment;
use App\Models\Doctor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

class AppointmentsDetails extends Component implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];

    #[Url]
    public $id;

    

    public function mount(): void
    {
        $this->form->fill();
        $this->dispatch('open-modal', id: 'cancel');
    }

    public function render()
    {
        return view('livewire.patient.appointments-details')->with([
            'appointment' => Appointment::find($this->id)
        ]);
    }

    public function destroy()
    {
        $appointment = Appointment::find($this->id);
        if ($appointment) {

            Notification::make()
                ->title('Appointment was cancelled')
                ->color('danger')
                ->danger()
                ->send();
            session()->flash('message', 'Your appointment with <span class="font-bold">' . $appointment->doctor->name . '</span> was cancelled');
            $appointment->update([
                'status' => 'Canceled',
            ]);
            $this->redirect('/patient-appointments', navigate: true);
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user_id')->default(Auth::id())->hidden(),
            ]);
    }
}
