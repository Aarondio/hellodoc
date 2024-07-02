<div class="">
    <div class="container mx-auto">
        <div class="flex justify-between mt-6 lg:px-6 px-4  w-100">
            <h1 class="font-bold text-gray-900 self-center">My Appointment</h1>
            <a href="{{ route('new-appointment') }}" class="bg-indigo-600 px-4 py-1 rounded-sm text-white flex">
               <x-icon name="plus-circle" class="self-center w-4 h-4 mr-1"/>
                <span class="self-center font-medium">New</span>
            </a>
        </div>
        <div class="grid-cols-12 gap-4 lg:grid lg:px-6 px-4  w-100 mb-20 mt-6">
            <div class="col-span-8">

                @if (session('message'))
                    <div class="bg-red-200 text-red-700 font-semibold p-5 rounded-lg my-3">
                        {!! session('message') !!}
                    </div>
                @endif
                <div class="grid grid-cols-3 gap-4 text-gray-600">
                    <a href="{{ route('upcoming') }}" wire:navigate>
                        <div
                            class="shadow-sm h-40 flex flex-col items-center justify-center   bg-white  sm:p-6 p-2 rounded-md text-center  hover:bg-indigo-600 hover:text-white">
                            <center>
                                <div class="bg-neutral-50 w-12 h-12 flex justify-center rounded-full ">
                                    <x-icon name="collection" class="w-6 text-indigo-700" />
                                </div>
                            </center>
                            <p class="font-semibold text-xs md:text-sm mt-2 text-center">Upcoming Apointments</p>
                            <p class="text-xs md:text-sm font-bold">{{ $u_appointments }}</p>
                        </div>
                    </a>
                    <a href="{{ route('pending') }}" wire:navigate>
                        <div
                            class="shadow-sm h-40 flex flex-col items-center justify-center  bg-white  sm:p-6 p-2 rounded-md text-center  hover:bg-indigo-600 hover:text-white">

                            <div class="bg-neutral-50  w-12 h-12 flex justify-center rounded-full">
                                <x-icon name="clipboard" class="w-6 text-indigo-700" />
                            </div>

                            <p class="font-semibold text-xs md:text-sm mt-2">Pending Apointments</p>
                            <p class="text-xs md:text-sm font-bold">{{ $p_appointments }}</p>
                        </div>
                    </a>

                    <a href="{{ route('history') }}" wire:navigate>
                        <div
                            class="shadow-sm h-40 flex flex-col items-center justify-center   bg-white  sm:p-6 p-2 rounded-md text-center  hover:bg-indigo-600 hover:text-white ">
                            <center>
                                <div class="bg-neutral-50  w-12 h-12 flex justify-center rounded-full">
                                    <x-icon name="check-circle" class="w-6 text-indigo-700" />
                                </div>
                            </center>
                            <p class="font-semibold text-xs md:text-sm mt-2">Apointments History</p>
                            <p class="text-xs md:text-sm font-bold">{{ $c_appointments }}</p>
                        </div>
                    </a>
                </div>
                <h1 class="mb-3 font-bold text-gray-900 mt-4"></h1>
                <div class="bg-white rounded-lg py-4 px-6">
                    <h1 class="font-semibold  text-sm ">Approved Appointments</h1>
                    @if ($a_appointments->isEmpty())
                        <div class="mt-2  bg-red-100 rounded-lg p-3 flex flex-col justify-center items-center">
                            <img src="{{ asset('images/empty.png') }}" class="w-40 " alt="Empty appointment">
                            <p class="text-red-600 ">You have no approved appointment</p>
                        </div>
                    @else
                        @foreach ($a_appointments as $appointment)
                            <a href="{{ route('pad', $appointment->id) }}" wire:navigate>
                                <div class="ring-1 mt-4 rounded-lg ring-neutral-200 p-2 ">
                                    <div
                                        class=" flex justify-between @if ($appointment->status == 'Confirmed') bg-green-100 @else bg-amber-100 @endif rounded-md p-3">
                                        <div class="flex">
                                            <div
                                                class=" @if ($appointment->status == 'Confirmed') bg-green-200 @else bg-amber-200 @endif  w-10 h-10 flex justify-center rounded-full">
                                                <x-icon name="clipboard" class="w-4  " />
                                            </div>
                                            <div class="self-center ml-4 text-gray-700">
                                                <p class="text-sm font-semibold">
                                                    {{ $appointment->doctor->department->name }}</p>
                                                <p class="text-sm font-semibold text-gray-700">
                                                    {{ $appointment->appointment_date->format('Y-M-d') . ' By ' . $appointment->appointment_time->format('H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                        {{-- <a
                                class=" text-gree-600 text-sm self-center ">Approved</a> --}}
                                    </div>
                                    <div class="mt-2 flex justify-between items-center">
                                        <div>
                                            <p class="text-sm leading-tight self-center text-neutral-600">
                                                {{ 'Doctor: ' . $appointment->doctor->name }}
                                            </p>
                                            <p class="text-sm leading-tight self-center text-neutral-600 mt-2">
                                                {{ 'Status:' }}
                                                <span
                                                    class="@if ($appointment->status == 'Confirmed') text-green-600 @else text-amber-600 @endif">{{ $appointment->status }}</span>
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

            <div class="col-span-4 ">
                <div class="bg-white rounded-lg py-4 px-6">
                    <h1 class="font-semibold  text-sm ">Pending Appointments</h1>
                    @if ($appointments->isEmpty())
                        <div class="mt-2  bg-red-100 rounded-lg p-3 flex flex-col justify-center items-center">
                            <img src="{{ asset('images/empty.png') }}" class="w-16 " alt="Empty appointment">
                            <p class="text-red-600 ">You have no pending appointment</p>
                        </div>
                    @else
                        @foreach ($appointments as $appointment)
                            <a href="{{ route('pad', $appointment->id) }}" wire:navigate>
                                <div class="ring-1 mt-4 rounded-lg ring-neutral-200 p-2 ">
                                    <div
                                        class=" flex justify-between @if ($appointment->status == 'Confirmed') bg-green-100 @else bg-amber-100 @endif rounded-md p-3">
                                        <div class="flex">
                                            <div
                                                class=" @if ($appointment->status == 'Confirmed') bg-green-200 @else bg-amber-200 @endif  w-10 h-10 flex justify-center rounded-full">
                                                <x-icon name="clipboard" class="w-4  " />
                                            </div>
                                            <div class="self-center ml-4 text-gray-700">
                                                <p class="text-sm font-semibold">
                                                    {{ $appointment->doctor->department->name }}</p>
                                                <p class="text-sm font-semibold text-gray-700">
                                                    {{ $appointment->appointment_date->format('Y-M-d') . ' By ' . $appointment->appointment_time->format('H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                        {{-- <a
                                class=" text-gree-600 text-sm self-center ">Approved</a> --}}
                                    </div>
                                    <div class="mt-2 flex justify-between items-center">
                                        <div>
                                            <p class="text-sm leading-tight self-center text-neutral-600">
                                                {{ 'Doctor: ' . $appointment->doctor->name }}
                                            </p>
                                            <p class="text-sm leading-tight self-center text-neutral-600 mt-2">
                                                {{ 'Status:' }}
                                                <span
                                                    class="@if ($appointment->status == 'Confirmed') text-green-600 @else text-amber-600 @endif">{{ $appointment->status }}</span>
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
</div>
