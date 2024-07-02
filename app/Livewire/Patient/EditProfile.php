<?php

namespace App\Livewire\Patient;

use App\Models\Appointment;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditProfile extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public User $user;
    public $image;

    public function mount(): void
    {
        $this->form->fill();
        // $this->user = User::where('id',Auth::id())->first();
    }

    public function render()
    {
        return view('livewire.patient.edit-profile');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // FileUpload::make('image')
                //     ->image()
                //     ->getUploadedFileNameForStorageUsing(
                //         fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                //             ->prepend(Auth::id(),'custom-prefix-', Auth::id()),
                //     )
                //     ->disk('public')
                //     ->directory('images')
                //     ->visibility('public')
                    // ->moveFiles()
                    // ->disk('public')
                    // ->label("")
                    // ->avatar()
                    // ->extraAttributes([
                    //     'loading' => 'lazy',
                    //     'class' => 'justify-center flex '
                    // ]),
                TextInput::make('name')
                    ->label("Full name")
                    ->placeholder("Full name")
                    ->default(Auth::user()->name),
                TextInput::make('email')
                    ->label("Email Address")
                    ->readOnly()
                    ->default(Auth::user()->email),
                Select::make('blood_group')
                    ->label("Blood Group")
                    ->options([
                        'A+' => 'A+',
                        'A-' => 'A-',
                        'B+' => 'B+',
                        'B-' => 'B-',
                        'O+' => 'O+',
                        'O-' => 'O-',
                        'AB+' => 'AB+',
                        'AB-' => 'AB-',
                    ])
                    ->default(Auth::user()->blood_group),
                Select::make('genotype')
                    ->label("Genotype")
                    ->options([
                        'AA' => 'AA',
                        'AS' => 'AS',
                        'AC' => 'AC',
                        'CC' => 'CC',
                        'SC' => 'SC',
                        'CC' => 'CC',
                    ])
                    ->default(Auth::user()->genotype)
            ])->statePath('data');
    }

    public function update()
    {
        $user = User::where('id', Auth::id())->first();
        if ($user) {
            $user->update($this->data);
        }
        // dd($this->data['image']);
    }

    public function uploadImage()
    {
        $user = User::find(Auth::id());
    
        // Validate the image file
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust the mime types and max size as needed
        ]);
    
        // Generate a unique name for the image
        $imageName = time() . '_' . $this->image->getClientOriginalName();
    
        // Store the image in the 'public/images' directory
        $this->image->storeAs('images', $imageName, 'public');
    
        // Update the user's image path in the database
        $user->update([
            'image' => $imageName,
        ]);
    }
    
}
