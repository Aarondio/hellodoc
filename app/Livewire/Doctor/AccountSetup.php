<?php

namespace App\Livewire\Doctor;

use App\Models\WorkingDays;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('components.layouts.doctor')]
class AccountSetup extends Component implements HasForms
{
    use InteractsWithForms;

    // public $id = "";



    public ?array $data = [];

    public function mount()
    {
        // $this->workingDay = WorkingDays::where('id', $this->id)
        //     ->where('doctor_id', 1)
        //     ->first();
        $this->form->fill();
    }
    public function render()
    {
        $workingDays = WorkingDays::where('doctor_id', Auth::guard('doctor')->id())->get();
        return view('livewire.doctor.account-setup')->with([
            'days' => $workingDays
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Toggle::make('is_working')
                ->accepted(true)
                ->label('Monday')
                ->default(true)
                ->onColor('primary'),

            Toggle::make('Tuesday')
                ->onColor('success'),
            Toggle::make('Wednesday')
                ->onColor('success'),
            Toggle::make('Thurday')
                ->onColor('success'),
            Toggle::make('Friday')
                ->onColor('success'),
            Toggle::make('Saturday')
                ->onColor('success'),
            Toggle::make('Sunday')
                ->onColor('success'),
            // ->offColor('danger')
        ]);
    }

    public function updateWorkingDay($id)
    {
        
        $workingDay = WorkingDays::find($id);

        if ($workingDay) {
            $workingDay->is_working = !$workingDay->is_working;
            $workingDay->save();
            // dd(!$workingDay->is_working);
            return redirect()->back();
        } 

        // dd($id);
    }




    // public function updateWorkingDay($id)
    // {
    //     // dd($this->id);
    //     $workingDay = WorkingDays::find($id);
    //         // ->where('doctor_id', 1)
    //         // ->first();


    //     $workingDay->update([
    //         'is_working' => !$workingDay->is_working
    //     ]);

    //     // dd(!$workingDay->is_working);
    // }
}
