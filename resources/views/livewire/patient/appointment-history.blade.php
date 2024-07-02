<div class="mt-2 sm:mt-8">
    <div class="container mx-auto">
        <a class="my-3 ml-4 flex md:hidden   text-indigo-600 underline text-md cursor-pointer" onclick="history.back()">
            <x-icon name="arrow-left" class="h-4 w-4  self-center" />
            <span class="self-center">Back</span>
        </a>
        <div class="flex flex-col items-center mb-20">

            <div class="w-11/12 lg:w-1/2   bg-white ring-1 ring-neutral-200 px-8 py-6 rounded-lg ">

                @if ($c_appointments->isEmpty())
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('images/empty.png') }}" class="h-24 w-24 opacity-35" alt="">
                        <p class="text-slate-400">No appointment history</p>
                    </div>
                @else
               <div class="mb-3">
                <h1 class="font-semibold text-slate-700">Appointment history</h1>
                
               </div>
                    @foreach ($c_appointments as $appointment)
                        <a href="{{ route('pad', $appointment->id) }}" wire:navigate>
                            <div class="ring-1 mt-2 rounded-lg  ring-neutral-100 p-2 shadow-sm">
                                <div
                                    class=" flex justify-between @if ($appointment->status == 'Confirmed') bg-green-100 @elseif ($appointment->status == 'Pending') bg-yellow-100 @else bg-neutral-100 @endif rounded-md p-3">
                                    <div class="flex">
                                        <div
                                            class=" @if ($appointment->status == 'Confirmed') bg-green-200 @elseif ($appointment->status == 'Pending') bg-yellow-200 @else bg-neutral-200 @endif  w-10 h-10 flex justify-center rounded-full">
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
                                    {{-- <a
                    class=" text-gree-600 text-sm self-center ">Approved</a> --}}
                                </div>
                                <div class="mt-2 flex justify-between items-center">
                                    <div>
                                        <p class="text-sm leading-tight self-center text-neutral-600">Status:
                                            <span class="font-semibold"> {{  $appointment->status }}</span>
                                        </p>
                                        <p class="text-sm leading-tight self-center text-neutral-600">Doctor:
                                            <span class="font-semibold"> {{  $appointment->doctor->name }}</span>
                                        </p>
                                        
                                        <p class="text-sm leading-tight self-center text-neutral-600">School Attended:
                                            <span class="font-semibold"> {{  $appointment->doctor->school_attended }}</span>
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
