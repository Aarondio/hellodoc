<?php

namespace App\Livewire\Patient;

use App\Mail\bookedAppointment;
use App\Models\Appointment;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Notifications\Notification;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Url;
use Livewire\Component;

class Reschedule extends Component implements HasForms
{
    use InteractsWithForms;

    #[Url]
    public $id;

    public ?array $data = [];

    public Appointment $appointment;

    public function mount()
    {
        $this->form->fill();
        $this->appointment = Appointment::find($this->id);
    }

    public function render()
    {
        return view('livewire.patient.reschedule')->with([
            "appointment" => $this->appointment,
        ]);
    }

    public function form(Form $form): Form
    {
        $appointment = Appointment::find($this->id);
        return $form->schema([

            DatePicker::make('appointment_date')
                ->label('New Appointment Date')
                ->minDate(now())
                ->default($appointment->appointment_date->format('Y-m-d')),
            TimePicker::make('appointment_time')
                ->label("New Appointment Time")
                ->default($appointment->appointment_time->format('H:i')),

        ])->statePath('data');
    }

    public function update(Appointment $appointment)
    {
        $appointment = Appointment::find($this->id);
        if ($appointment) {
            $emailMessage = "Congratulations! Your appointment has been reschedule successfully.<br/>Here are the details of your appointment:";
            Notification::make()
                ->title('Appointment has been rescheduled')
                ->success()
                ->send();
            session()->flash('message', 'Appointment has been reschedule successfully');
            $appointment->update($this->data);
            Mail::to($appointment->user->email)->send(new bookedAppointment($emailMessage,$appointment,"Your Appointment Has Been Reschedule Successfully Booked!"));
            return $this->redirectRoute('reschedule', $appointment->id, navigate: true);
        }
    }
}
