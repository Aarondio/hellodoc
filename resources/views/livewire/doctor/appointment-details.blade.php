<div class="mt-2">
    <div class="container mx-auto">
        <a class="mt-3 ml-3  text-indigo-600 underline text-md flex cursor-pointer" onclick="history.back()">
            <x-icon name="arrow-left" class="h-4 w-4  self-center" />
            <span class="self-center">Back</span>
        </a>
        <div class="p-4 flex flex-col lg:px-12 px-4 items-center justify-center ">

            <div class="lg:w-1/2  bg-white ring-1 ring-neutral-200 lg:p-8 p-4 rounded-lg ">


                <h1 class="font-semibold  text-sm self-center">Patient Record</h1>
                <div class="mt-4 flex bg-neutral-50 p-3 rounded-lg">

                    {{-- <img src="{{ asset('images/profilepix.jpeg') }}"
                        class="h-16 w-16 rounded-full border-2 border-indigo-400" /> --}}
                    <div class="self-center ">

                        <p>{{ $appointment->user->name }}</p>

                        <p class="text-sm text-slate-500">Blood Group: <span
                                class="font-bold">{{ $appointment->user->blood_group }}</span></p>
                        <p class="text-sm text-slate-500">Genotype: <span
                                class="font-bold">{{ $appointment->user->genotype }}</span></p>
                    </div>
                </div>
                <h1 class="font-semibold  text-sm self-center mt-3">Appointments Details</h1>
                <div class="mt-2 bg-neutral-50 p-3 rounded-lg">

                    <div class="mt-2 flex">

                        <div class="self-center ">

                            <p class="text-sm text-slate-500">Date: <span
                                    class="font-bold">{{ $appointment->appointment_date->format('Y-M-d') }}</span>
                            </p>
                            <p class="text-sm text-slate-500">Time: <span
                                    class="font-bold">{{ $appointment->appointment_time->format('H:i') }}</span></p>
                            <p class="text-sm text-slate-500">
                                Status: <span class="font-bold">
                                    {!! $appointment->status == 'Confirmed'
                                        ? '<span class="text-green-500">Approved</span>'
                                        : '<span class="text-yellow-500">Pending</span>' !!}
                                </span>
                            </p>
                            <h1 class="text-sm text-slate-500">Appointment Description:</h1>
                            <p class="text-sm">{!! $appointment->description ?? 'No description added' !!}</p>
                            <h1 class="text-sm text-slate-500">Doctor's recommendation:</h1>
                            <p class="text-sm">{!! $appointment->recommendation ?? 'No recommendation' !!}</p>
                        </div>
                    </div>
                </div>


                @if ($appointment->appointment_date->isFuture() || $appointment->appointment_date->isToday())
                    <div class="mt-6 flex gap-2">
                        @if ($appointment->status == 'Confirmed')
                            <x-filament::button class="bg-green-600" disabled>
                                Confirmed
                            </x-filament::button>
                        @else
                            <x-filament::modal alignment="center" class="self-center" id="cancel">
                                <x-slot name="trigger">
                                    <x-filament::button wire:loading.attr="disabled"
                                        class="bg-green-600 hover:bg-green-700 disabled:bg-green-400">
                                        Confirm

                                    </x-filament::button>
                                </x-slot>

                                {{-- Modal content --}}
                                <x-slot name="heading">
                                    Appointment Approval
                                </x-slot>
                                <x-slot name="description" class="py-4">
                                    <div class="flex justify-center my-2">
                                        <x-heroicon-o-exclamation-circle class="h-8 w-8 text-yellow-500" />
                                    </div>
                                    You are about to appove an appointment scheduled for
                                    <strong>{{ $appointment->appointment_date->format('Y-M-d') . ' By ' . $appointment->appointment_time->format('H:i') }}</strong>
                                    <div class="mb-6 ">

                                        <form wire:submit="approve" class="mt-5">
                                            <div class="my-3">
                                                <label for="Recommendation" class="font-medium text-left">Recommendation
                                                    <span class="text-sm text-red-600">(optional)</span></label>
                                                <textarea wire:model="recommendation" placeholder="Doctor's recommendation"
                                                    class="w-full border-1 border-gray-300 rounded-md placeholder:text-sm" cols="30" rows="5"></textarea>
                                            </div>
                                            <button
                                                class="bg-green-500 leading-6 px-4 py-1 rounded-md  text-white hover:bg-green-700 flex gap-1">Approve
                                                <x-filament::loading-indicator
                                                    class="h-5 w-5 text-white self-center ms-2" wire:loading />
                                            </button>
                                        </form>

                                    </div>
                                </x-slot>

                            </x-filament::modal>
                        @endif

                        <x-filament::modal alignment="center" class="self-center" id="cancel">
                            <x-slot name="trigger">
                                <x-filament::button class="bg-indigo-600 hover:bg-indigo-700">
                                    Reschedule
                                </x-filament::button>
                            </x-slot>

                            {{-- Modal content --}}
                            <x-slot name="heading">
                                Reschedule Appointment
                            </x-slot>
                            <x-slot name="description" class="py-4">
                                {{-- <div class="flex justify-center my-2">
                                <x-heroicon-o-exclamation-circle class="h-8 w-8 text-yellow-500" />
                            </div> --}}

                                <div class="mb-6 flex justify-center gap-4">
                                    <form wire:submit="reschedule" class="mt-5">
                                        {{ $this->form }}



                                        <button
                                            class="bg-indigo-600 mt-4 w-full text-center  leading-6 px-4 py-2 rounded-md  text-white hover:bg-indigo-700 flex justify-center align-center gap-1">Reschedule</button>
                                    </form>

                                </div>
                            </x-slot>

                        </x-filament::modal>
                        {{-- <x-filament::button href="{{ route('reschedule', $appointment->id) }}" tag="a">
                        Reschedule
                    </x-filament::button> --}}
                        {{-- <a href="{{ route('reschedule', $appointment->id) }}"
                        class=" bg-indigo-600 px-4 leading-14  font-medium py-1 rounded-md  text-white hover:bg-indigo-700">Reschedule</a> --}}
                    </div>


                    {{-- @else
                  <div class="bg-red-100 p-4">
                     <p class="text-center text-red-600">The scheduled date for this appointment has passed</p>
                  </div> --}}
                @endif
            </div>

        </div>

        <div class="p-4 flex flex-col lg:px-12 px-4 items-center justify-center mb-20">

            <div class="lg:w-1/2  bg-white ring-1 ring-neutral-200 lg:p-8 p-4 rounded-lg ">
                <h1 class="text-lg font-medium mb-4">Old Appointment Records</h1>

                @if ($appointments->isEmpty())
                    <div class="bg-red-100">
                        <p class="text-red-500">{{ 'No appointment record' }}</p>
                    </div>
                @else
                    @foreach ($appointments as $appointment)
                        <div class="self-center bg-neutral-50 p-4 mb-4 rounded-md">

                            <p class="text-sm text-slate-500">Date: <span
                                    class="font-bold">{{ $appointment->appointment_date->format('Y-M-d') }}</span>
                            </p>
                            <p class="text-sm text-slate-500">Time: <span
                                    class="font-bold">{{ $appointment->appointment_time->format('H:i') }}</span></p>
                            <p class="text-sm text-slate-500">
                                Status: <span class="font-bold">
                                    {!! $appointment->status == 'Confirmed'
                                        ? '<span class="text-green-500">Approved</span>'
                                        : '<span class="text-yellow-500">Pending</span>' !!}
                                </span>
                            </p>
                            <h1 class="text-sm text-slate-500">Appointment Description:</h1>
                            <p class="text-sm">{!! $appointment->description ?? 'No description added' !!}</p>
                            <h1 class="text-sm text-slate-500">Doctor's Recommendation:</h1>
                            <p class="text-sm">{!! $appointment->recommendation ?? 'No recommendation' !!}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        // $dispatch('open-modal', { id: 'cancel' })
    </script>
</div>
