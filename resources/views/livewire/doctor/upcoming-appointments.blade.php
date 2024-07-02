<div class="mt-2">
    <div class="container ">
        <a class="my-3 ml-3  text-indigo-600 underline text-md flex cursor-pointer" onclick="history.back()">
            <x-icon name="arrow-left" class="h-4 w-4  self-center" />
            <span class="self-center">Back</span>
        </a>
        <div class="flex flex-col items-center ">

            <div class="w-11/12 lg:w-1/2   bg-white ring-1 ring-neutral-200 px-8 py-6 rounded-lg ">

                @if ($appointments->isEmpty())
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('images/empty.png') }}" class="h-24 w-24 opacity-35" alt="">
                        <p class="text-slate-400">No upcoming appointment history</p>
                    </div>
                @else
                    <div class="mb-3">
                        <h1 class="font-semibold text-slate-700">Upcoming Appointment</h1>

                    </div>
                    @foreach ($appointments as $appointment)
                        <a href="{{ route('dad', $appointment->id) }}" wire:navigate>
                            <div class="ring-1 mt-2 rounded-lg ring-neutral-100 p-2 shadow-sm">
                                <div
                                    class=" flex justify-between bg-green-100 rounded-md p-3">
                                    <div class="flex">
                                        <div
                                            class="   bg-green-200  w-10 h-10 flex justify-center rounded-full">
                                            <x-icon name="document-text" class="w-4  " />
                                        </div>
                                        <div class="self-center ml-4 text-gray-700">
                                            <p class="text-sm font-semibold">
                                                {{ $appointment->doctor->department->name }}</p>
                                            <p class="text-sm font-semibold text-gray-700">
                                                {{ $appointment->appointment_date->format('Y-M-d') . ' At ' . $appointment->appointment_time->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <a
                                        class=" text-green-700 bg-green-300 py-1 px-2 rounded-full text-sm self-center font-semibold">{{ $appointment->status }}</a>
                                </div>
                                <div class="mt-2 flex justify-between items-center">
                                    <div>
                                        <p class="text-sm leading-tight self-center text-neutral-600">Patient:
                                            <span class="font-semibold"> {{  $appointment->user->name }}</span>
                                        </p>
                                       


                                    </div>

                                    {{-- <a href="#" class="self-center underline text-red-500">Cancel</a> --}}
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
