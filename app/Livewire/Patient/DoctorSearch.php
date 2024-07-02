<?php

namespace App\Livewire\Patient;

use App\Mail\bookedAppointment;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class DoctorSearch extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount()
    {
        $this->form->fill();
    }
    public function render()
    {
        return view('livewire.patient.doctor-search');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('doctor_id')
                ->prefixIcon('heroicon-o-user')
                ->required()
                ->options(fn (): Collection => Doctor::query()
                    ->where('is_available', 1)
                    ->pluck('doctors.name', 'doctors.id'))
                ->searchable()
                ->searchPrompt('Search doctors by their name')
                ->noSearchResultsMessage('No Doctor found, try changing department.')
                ->label("Search Doctors")
                ->live(),
            TextInput::make('user_id')
                ->default(Auth::id())
                ->hidden(),
            DatePicker::make('appointment_date')
                ->prefixIcon('heroicon-o-calendar')
                ->required()
                ->label("Appointment Date")
                ->required()
                ->minDate(now())
                ->placeholder("Appointment Date")
                ->closeOnDateSelection()
                ->native(false),
            TimePicker::make('appointment_time')
                ->required()
                ->prefixIcon('heroicon-o-clock')
                ->label("Appointment Time")
                ->seconds(false),
            RichEditor::make('description')
                ->label("Description")
                ->hint("Optional")
                ->hintColor('danger')
                ->toolbarButtons([
                    'bold',
                    'bulletList',
                    'orderedList',
                    'redo',
                    'underline',
                    'undo',
                ]),
        ])->statePath('data');;
    }

    public function create()
    {

 
        $appointment = Appointment::create($this->data);
        $doctor = Doctor::find($this->data['doctor_id']);
        if ($appointment) {
            $emailMessage = "<span style='font-weight:bold;color:black'>Hello <br>". $appointment->user->name ."</span><br/>Your appointment has been successfully booked.We look forward to providing you with the best possible care.<br/>Here are the details of your appointment:";
            $docMessage = "<span style='font-weight:bold;color:black'>Hello <br>". $appointment->doctor->name ."</span><br/>An appointment has been booked with you by ". $appointment->user->name .". <br/>Here are the details of your appointment:";
            try {
                Mail::to($appointment->user->email)->send(new bookedAppointment($emailMessage, $appointment, "Your Appointment Has Been Successfully Booked!"));
                Mail::to($appointment->doctor->email)->send(new bookedAppointment($docMessage, $appointment, "Appointment Booking"));
            } catch (\Exception $e) {
                Log::error('Failed to send appointment email: ' . $e->getMessage());
            } finally {
                Notification::make()
                    ->title('Appointment has been booked')
                    ->success()
                    ->send();

                return redirect()->route('patient-dashboard')->with([
                    'status' => 'Congratulations! your appointment with <span class="font-bold text-slate-900">' . $doctor->name . '</span> has been booked',
                ]);
            }
            //  Mail::to($appointment->user->email)->send(new bookedAppointment($emailMessage,$appointment,"Your Appointment Has Been Successfully Booked!"));
            //  Mail::to($appointment->doctor->email)->send(new bookedAppointment($docMessage,$appointment,"Appointment Booking"));
  
            // Notification::make()
            //     ->title('Appointment has been booked')
            //     ->success()
            //     ->send();
            // return redirect()->route('patient-dashboard')->with([
            //     'status' => 'Congratulations! your appointment with <span class="font-bold text-slate-900">' . $doctor->name . '</span> has been booked',
            // ]);
        }
    }
}
