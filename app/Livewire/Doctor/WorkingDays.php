<?php

namespace App\Livewire\Doctor;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.doctor')]
class WorkingDays extends Component
{
    public function render()
    {
        return view('livewire.doctor.working-days');
    }
}
