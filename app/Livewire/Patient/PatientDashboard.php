<?php

namespace App\Livewire\Patient;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\User;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PatientDashboard extends Component implements HasForms
{
    public $title = 'Patient Dashboard';

    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }
    
    public function render()
    {
        $appointments = Appointment::where('user_id', Auth::id())
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','!=','Canceled')
        ->orderBy('appointment_date')
        ->get();

        $p_appointments = Appointment::where('user_id', Auth::id())
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','Pending')
        ->count();

        $u_appointments = Appointment::where('user_id', Auth::id())
        ->whereDate('appointment_date', '>=', Carbon::today())
        ->where('status','!=','Canceled')
        ->count();

        $c_appointments = Appointment::where('user_id', Auth::id())
        ->whereDate('appointment_date', '<', Carbon::today())
        ->where('status','!=','Canceled')
        ->count();
        

        return view('livewire.patient.patient-dashboard')->with([
            'appointments' => $appointments,
            'p_appointments' => $p_appointments,
            'u_appointments' => $u_appointments,
            'c_appointments' => $c_appointments,
        ]);
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('patient_id')->default(Auth::id())->hidden(),
                Select::make('department_id')
                    ->label("Department")
                    ->options(Department::all()->pluck('name', 'id'))
                    ->searchable()
                    ->live(),
                Select::make('doctor_id')
                    ->options(fn (Get $get): Collection => User::query()
                        ->where('user_type', 2)
                        ->join('doctors', 'users.id', '=', 'doctors.user_id')
                        ->where('doctors.department_id', $get('department_id'))
                        ->pluck('users.name', 'users.id'))
                    ->searchable()
                    ->label("Who to see"),
                RichEditor::make('description')
                    ->label("Description")
                    ->hint("Optional")
                    ->hintColor('danger')
                    ->toolbarButtons([
                        'bold',
                        'bulletList',
                        'h2',
                        'h3',
                        'italic',
                        'orderedList',
                        'redo',
                        'underline',
                        'undo',
                    ]),

            ])->statePath('data');
    }

    public function create()
    {
        dd($this->data);
    }
}
