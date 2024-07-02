<div class="mt-2">
    <div class="container mx-auto">
        <a class="mt-3 ml-3  text-indigo-600 underline text-md flex cursor-pointer" onclick="history.back()">
            <x-icon name="arrow-left" class="h-4 w-4  self-center" />
            <span class="self-center">Back</span>
        </a>
        <div class="p-4 flex flex-col lg:px-12 px-4 items-center justify-center mb-20">

            <div class="lg:w-1/2  bg-white ring-1 ring-neutral-200 lg:p-8 p-4 rounded-lg ">

                <div class="bg-yellow-50 p-4 rounded-md">
                    <p class="font-normal text-sm text-black">Your personal information that are visible to the
                        doctor includes. <strong>(Name,blood group,genotype, previous medical records)</strong></p>
                </div>

               
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
                        {{-- <img src="{{ asset('images/profilepix.jpeg') }}"
                            class="h-16 w-16 rounded-full border-2 border-indigo-400" /> --}}
                        <div class="self-center ">
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
                <div class="mt-5 bg-neutral-50 p-3 rounded-lg">
                    <h1 class="font-semibold  text-sm self-center">Doctors Recommendation</h1>
                    <div class="mt-2 flex">
                        {{-- <img src="{{ asset('images/profilepix.jpeg') }}"
                            class="h-16 w-16 rounded-full border-2 border-indigo-400" /> --}}
                        <div class="self-center ">
                            <p class="text-sm text-slate-500"><span
                                    class="font-bold">{{ $appointment->recommendation ?? 'No recommendation' }}</span>
                            </p>
                           
                        </div>
                    </div>
                </div>
                @if ($appointment->appointment_date->isFuture() || $appointment->appointment_date->isToday())
                    <div class="mt-6 flex gap-2">
                        <x-filament::modal alignment="center" class="self-center" id="cancel">
                            <x-slot name="trigger">
                                <x-filament::button class="bg-red-600 hover:bg-red-700">
                                    Cancel
                                </x-filament::button>
                            </x-slot>

                            {{-- Modal content --}}
                            <x-slot name="heading">
                                Cancel Appointment
                            </x-slot>
                            <x-slot name="description" class="py-4">
                                <div class="flex justify-center my-2">
                                    <x-heroicon-o-exclamation-circle class="h-8 w-8 text-red-700" />
                                </div>
                                Are you sure you want to cancel appointment?
                                <div class="mb-6 flex justify-center gap-4">
                                    <form wire:submit="destroy">
                                        <button
                                            class="bg-red-500 px-4 py-1 rounded-md mt-5 text-white hover:bg-red-700 flex gap-1">Proceed
                                            <x-heroicon-o-arrow-right class="h-4 w-4 self-center" /></button>
                                    </form>

                                </div>
                            </x-slot>

                        </x-filament::modal>
                        {{-- <form wire:submit="destroy">
                        <button class="bg-red-500 px-4 py-2 rounded-md mt-5 text-white hover:bg-red-700"
                            onclick=" return confirm('Are you sure you want to cancel appointment?')">Cancel</button>
                    </form> --}}

                        <a href="{{ route('reschedule', $appointment->id) }}"
                            class=" bg-indigo-600 px-4 leading-14  font-medium py-1 rounded-md  text-white hover:bg-indigo-700">Reschedule</a>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script>
        // $dispatch('open-modal', { id: 'cancel' })
    </script>
</div>
