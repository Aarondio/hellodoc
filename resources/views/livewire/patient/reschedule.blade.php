<div class="mt-2">
    <div class="container mx-auto">
        <a href="{{ route('patient-appointments') }}" class="mt-3 ml-3  text-indigo-600 underline text-md flex cursor-pointer" >
            <x-icon name="arrow-left" class="h-4 w-4  self-center" />
            <span class="self-center">Appointments</span>
        </a>
        <div class="p-4 flex flex-col px-12 items-center justify-center">

            <div class="lg:w-1/2  bg-white ring-1 ring-neutral-200 px-8 py-6 rounded-lg ">

                {{-- @if (session('message'))
                    <div class="bg-green-200 text-green-700 font-semibold p-5 rounded-lg my-3">
                        {!! session('message') !!}
                    </div>
                @endif --}}


                <div class="mt-5 bg-neutral-50 p-3 rounded-lg">
                    <h1 class="font-semibold  text-sm self-center">Appointments Details</h1>

                   

                    <div class="mt-2 flex">

                        <div class="self-center ">

                            <p class="text-sm text-slate-500">Date: <span
                                    class="font-bold">{{ $appointment->appointment_date->format('Y-M-d') }}</span>
                            </p>
                            <p class="text-sm text-slate-500">Time: <span
                                    class="font-bold">{{ $appointment->appointment_time->format('H:i') }}</span></p>
                            <h1 class="text-sm text-slate-500">Appointment Description:</h1>
                            <p class="text-sm">{!! $appointment->description ?? 'No description added' !!}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 bg-neutral-50 p-3 rounded-lg">
                    <h1 class="font-semibold  text-sm self-center">Doctors Details</h1>
                    <div class="mt-2 flex">
                        <img src="{{ asset('images/profilepix.jpeg') }}"
                            class="h-16 w-16 rounded-full border-2 border-indigo-400" />
                        <div class="self-center ml-4">
                            <p class="text-sm text-slate-500">Full name: <span
                                    class="font-bold">{{ $appointment->doctor->name }}</span>
                            </p>
                            <p class="text-sm text-slate-500">Department: <span
                                    class="font-bold">{{ $appointment->doctor->department->name }}</span></p>
                            <p class="text-sm text-slate-500">School Attended: <span
                                    class="font-bold">{{ $appointment->doctor->school_attended }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="mt-3 flex">
                    <form wire:submit="update">
                        {{ $this->form }}
                        <button class="bg-green-500 px-4 py-2 rounded-md mt-5 text-white hover:bg-green-700 flex disabled:bg-green-400"
                            onclick=" return confirm('Are you sure you want to change appointment?')" wire:loading.attr="disabled">
                            Update
                            <x-filament::loading-indicator class="h-5 w-5 text-white self-center ms-2" wire:loading/>
                         
                        </button>
                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
