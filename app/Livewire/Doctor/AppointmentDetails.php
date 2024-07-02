<?php

namespace App\Livewire\Doctor;

use App\Mail\bookedAppointment;
use App\Models\Appointment;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.doctor')]
class AppointmentDetails extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public $recommendation;

    #[Url]
    public $id;

    public function mount()
    {
        $this->form->fill();
    }

    public function render()
    {
        $appointment = Appointment::findorFail($this->id);
        $appointments =  Appointment::where('user_id', $appointment->user_id)->orderBy('appointment_date', 'desc')->get();
        return view('livewire.doctor.appointment-details')->with([
            'appointment' => $appointment,
            'appointments' => $appointments
        ]);
    }

    public function approve()
    {
        $appointment = Appointment::find($this->id);
        if ($appointment) {
            $appointment->status = "Confirmed";
            $appointment->recommendation = $this->recommendation;
            $appointment->save();
            $message = "<span style='font-weight:bold;color:black'>Hello <br>" . $appointment->user->name . "</span><br/>Your appointment has been approved by " . $appointment->doctor->name . ". <br/>Here are the details of your appointment:";

            try {
                Mail::to($appointment->user->email)->send(new bookedAppointment($message, $appointment, "Your Appointment Has Been Approved"));
            } catch (\Exception $e) {
                Log::error('Failed to send appointment email: ' . $e->getMessage());
            } finally {
                Notification::make()
                    ->title('Appointment has been approved')
                    ->success()
                    ->send();
                return $this->redirectRoute('doctor-appointments');
            }
        }
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



    public function reschedule()
    {
        $appointment = Appointment::find($this->id);
        if ($appointment) {
            $message = "<span style='font-weight:bold;color:black'>Hello <br>" . $appointment->user->name . "</span><br/>Your appointment has been reschedule by " . $appointment->doctor->name . ". <br/>Here are the details of your appointment:";

            try {
                Mail::to($appointment->user->email)->send(new bookedAppointment($message, $appointment, "Your Appointment Has Been Approved"));
            } catch (\Exception $e) {
                Log::error('Failed to send appointment email: ' . $e->getMessage());
            } finally {
                Notification::make()
                    ->title('Appointment has been rescheduled')
                    ->success()
                    ->send();
                session()->flash('message', 'Appointment has been updated successfully');
                $appointment->update($this->data);
                return $this->redirectRoute('doctor-appointments', $appointment->id, navigate: true);
            }
        }
    }
}
