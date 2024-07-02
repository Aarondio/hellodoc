<div class="mt-2">
    <div class="container mx-auto ">

        <div class="grid-cols-12 gap-4 lg:grid lg:px-6 px-4  w-100 mb-20 ">
            <div class="col-span-8">

                <div class="py-1 px-6 col-span-6 ">

                    <h1 class="mb-3 font-bold text-gray-900 ">Dashboard</h1>
                    <div
                        class="lg:p-12 p-6 bg-success-300 rounded-lg text-600-green flex justify-between ring-2 ring-success-500">
                        <h1 class="self-center">Welcome Back, Dr. @auth('doctor')
                                <strong>{{ Auth::guard('doctor')->user()->name }} </strong>
                            @endauth
                        </h1>
                        <a href="{{ route('das') }}"
                            class="bg-white self-center px-4 py-2 outline-none flex rounded-lg text-indigo-700 shadow ring-2 font-medium"
                            wire:navigate>
                            <x-icon name="pencil-alt" class="w-5  mr-2" />
                            Profile
                        </a>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-6">

                        <a href="{{ route('upcoming-appointments') }}" wire:navigate>
                            <div
                                class="shadow-sm h-40 flex flex-col items-center justify-center   bg-white  sm:p-6 p-2 rounded-md text-center  hover:bg-indigo-600 hover:text-white">
                                <center>
                                    <div class="bg-neutral-50 w-12 h-12 flex justify-center rounded-full ">
                                        <x-icon name="collection" class="w-6 text-indigo-700" />
                                    </div>
                                </center>
                                <p class="font-semibold text-xs lg:text-sm mt-2 text-center">Upcoming Apointments</p>
                                <p class="text-xs lg:text-sm font-bold">{{ $u_appointments }}</p>
                            </div>
                        </a>
                        <a href="{{ route('pending-appointments') }}" wire:navigate>
                            <div
                                class="shadow-sm h-40 flex flex-col items-center justify-center  bg-white  sm:p-6 p-2 rounded-md text-center  hover:bg-indigo-600 hover:text-white">

                                <div class="bg-neutral-50  w-12 h-12 flex justify-center rounded-full">
                                    <x-icon name="clipboard" class="w-6 text-indigo-700" />
                                </div>

                                <p class="font-semibold text-xs lg:text-sm mt-2">Pending Apointments</p>
                                <p class="text-xs lg:text-sm font-bold">{{ $p_appointments }}</p>
                            </div>
                        </a>

                        <a href="{{ route('appointments-history') }}" wire:navigate>
                            <div
                                class="shadow-sm h-40 flex flex-col items-center justify-center   bg-white  sm:p-6 p-2 rounded-md text-center  hover:bg-indigo-600 hover:text-white ">
                                <center>
                                    <div class="bg-neutral-50  w-12 h-12 flex justify-center rounded-full">
                                        <x-icon name="check-circle" class="w-6 text-indigo-700" />
                                    </div>
                                </center>
                                <p class="font-semibold text-xs lg:text-sm mt-2">Apointments History</p>
                                <p class="text-xs lg:text-sm font-bold">{{ $c_appointments }}</p>
                            </div>
                        </a>

                    </div>

                </div>
                <div class=" py-4 px-6 ">

                    <div class="bg-white p-4 rounded-lg">
                        <h1 class="font-semibold  text-sm ">Pending Appointments</h1>
                        @if ($pendingappointments->isEmpty())
                            <div class="mt-2  bg-red-100 rounded-lg p-3 flex flex-col justify-center items-center">
                                <img src="{{ asset('images/empty.png') }}" class="w-40 " alt="Empty appointment">
                                <p class="text-red-600 ">You have no pending appointment</p>
                            </div>
                        @else
                            @foreach ($pendingappointments as $appointment)
                                <a href="{{ route('dad', $appointment->id) }}" wire:navigate>
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
                                                        {{ $appointment->appointment_date->format('Y-M-d') . ' By ' . $appointment->appointment_time->format('h:i A') }}
                                                    </p>
                                                </div>
                                            </div>
                                            {{-- <a
                                class=" text-gree-600 text-sm self-center ">Approved</a> --}}
                                        </div>
                                        <div class="mt-2 flex justify-between items-center">
                                            <div>
                                                <p class="text-sm leading-tight self-center text-neutral-600">
                                                    {{ 'Patient: ' . $appointment->user->name }}
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
            <div class="col-span-4 mt-7">
                <div class="bg-neutral-50 rounded-lg py-4 px-6 col-span-3 mt-3">
                    <h1 class="font-semibold text-sm">Personal Information</h1>
                    <div class="mt-4 flex">
                        {{-- <img src="{{ asset('images/profilepix.jpeg') }}" class="h-16 w-16 rounded-full" /> --}}
                        <div class="self-center">

                            <p>{{ Auth::guard('doctor')->user()->name }}</p>


                            <p class="text-sm text-slate-500">
                                {{ Auth::guard('doctor')->user()->Department->name ?? 'Not specified' }}</p>
                        </div>
                    </div>

                    <div class="flex mt-5 justify-between">
                        <h1 class="font-semibold text-sm">Working Days</h1>
                        @if ($days->isEmpty())
                            <a href="" class="self-center flex text-indigo-700 font-semibold">
                                <x-icon name="pencil" class="w-4 mr-1" />
                                Add
                            </a>
                        @else
                            <a href="{{ route('das') }}" class="self-center flex text-indigo-700 font-semibold"
                                wire:navigate>
                                <x-icon name="pencil" class="w-4 mr-1" />
                                Edit
                            </a>
                        @endif
                    </div>
                    @if ($days->isEmpty())
                        <div class="bg-red-100 p-3 rounded-md">
                            <p class="text-red-700">You have not set working days</p>
                        </div>
                    @else
                        <div class="mt-4 grid grid-cols-3 gap-4 justify-between  rounded-lg ">
                            @foreach ($days as $day)
                                <div
                                    class="px-3 py-1 relative text-indigo-600 rounded-lg text-center bg-indigo-50 text-sm self-center ring-1 ring-indigo-100 hover:bg-indigo-100 cursor-pointer">
                                    {{ $day->day }}
                                    {{-- <a
                                        class="-top-2 -right-2 absolute rounded-full bg-indigo-100 ring-1 ring-indigo-100 hover:bg-indigo-50">
                                        <x-icon name="trash" class="h-4 w-4 text-indigo-600 hover:text-red-600 " />
                                    </a> --}}
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="flex mt-5 justify-between">
                        <h1 class="font-semibold  text-sm">Approved Appointments</h1>
                        <a href="{{ route('doctor-appointments') }}"
                            class="self-center flex text-gray-400 font-semibold text-sm hover:text-indigo-600">
                            view all
                            <x-icon name="chevron-right" class="h-3 w-3 self-center" />
                        </a>
                    </div>
                    @if ($approvedappointments->isNotEmpty())
                        @foreach ($approvedappointments as $appointment)
                            <div class="mt-2 flex justify-between bg-white rounded-lg p-3">
                                <div class="flex">
                                    <div class="bg-slate-100 w-12 h-12 flex justify-center rounded-full">
                                        <x-icon name="clipboard" class="w-6 text-indigo-700" />
                                    </div>
                                    <div class="self-center ml-4">
                                        <p>{{ $appointment->user->name }}</p>
                                        <p class="text-sm text-slate-500">{{ $appointment->appointment_date->format('Y-M-d'). ' ' . $appointment->appointment_time->format('h:i A') }}</p>
                                    </div>
                                </div>
                                <a href="{{route('dad',$appointment->id)}}"
                                    class="px-3 py-1 text-white rounded-full bg-indigo-600 text-sm self-center ring-2 ring-indigo-100 hover:bg-indigo-700 cursor-pointer">View</a>
                            </div>
                        @endforeach
                    @else
                        <div class="p-4 bg-red-100 rounded-md mt-3">
                            <p class="text-red-600">No approved appointment at the moment</p>
                        </div>
                    @endif

                   

                </div>

            </div>
        </div>
    </div>
</div>
