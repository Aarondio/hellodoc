<div class="mb-24 ">
    <div class="container  mx-auto w-100">
        <div class="grid-cols-12 gap-4 lg:grid px-4 sm:p-6  mb-20">
            <div class="col-span-8">

                <h1 class="mb-3 font-bold text-gray-900 ">Dashboard</h1>
               
                
                {{-- @if (session('status'))
                    <div class="bg-green-200 text-green-700 font-semibold p-5 rounded-lg my-3">
                        {!! session('status') !!}
                    </div>
                @endif --}}
                <div class="p-12 bg-indigo-600 rounded-lg text-white flex justify-between">
                    <h1 class="self-center">Welcome Back, @auth
                            <strong>{{ Auth::user()->name }} </strong>
                        @endauth
                    </h1>
                    <a href="{{ route('edit-profile') }}" wire:navigate
                        class="bg-white self-center px-4 py-2 outline-none flex rounded-lg text-indigo-700 shadow ring-2 font-medium">
                        <x-icon name="pencil-alt" class="w-5  mr-2" />
                        Profile
                    </a>
                </div>



                <h1 class="mb-3 font-bold text-gray-900 mt-3">Quick Actions</h1>

                <div class="grid grid-cols-3 gap-4 text-gray-600">


                    <a href="{{ route('new-appointment') }}" wire:navigate>
                        <div
                            class="shadow-sm flex flex-col items-center justify-center  bg-indigo-200 text-indigo-800 sm:p-6 p-2 rounded-md text-center h-28 hover:bg-indigo-300 ">
                            <center>
                                <div class="bg-neutral-50 w-10 h-10 flex justify-center items-center rounded-full">
                                    <x-icon name="plus" class="w-6" />
                                </div>
                            </center>
                            <p class="font-semibold text-sm mt-2 text-center">New Apointment</p>
                        </div>
                    </a>
                    <a href="{{ route('doctor-search') }}" wire:navigate>
                        <div
                            class="shadow-sm flex flex-col items-center justify-center  bg-blue-200 text-indigo-800 sm:p-6 p-2 rounded-md text-center h-28  hover:bg-blue-300 ">
                            <center>
                                <div class="bg-neutral-50 w-10 h-10 flex justify-center rounded-full">
                                    <x-icon name="search" class="w-6" />
                                </div>
                            </center>
                            <p class="font-semibold text-sm mt-2 text-center">Doctor Search</p>
                        </div>
                    </a>
                    <a href="{{ route('history') }}" wire:navigate>
                        <div
                            class="shadow-sm flex flex-col items-center justify-center   bg-violet-200 text-indigo-800 sm:p-6 p-2 rounded-md text-center h-28  hover:bg-violet-300 ">
                            <center>
                                <div class="bg-neutral-50 w-10 h-10 flex justify-center rounded-full">
                                    <x-icon name="archive" class="w-6" />
                                </div>
                            </center>
                            <p class="font-semibold text-sm mt-2 text-center">Book History</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-span-4 ">
                <h1 class="mb-3 font-bold text-gray-900 mt-9"></h1>
                <div class="bg-white rounded-lg py-4 px-6">
                    <h1 class="font-semibold text-sm">Personal Information</h1>
                    <div class="mt-4 flex">
                        {{-- <img src="{{ asset('images/profilepix.jpeg') }}" class="h-16 w-16 rounded-full" /> --}}
                        <div class="self-center">

                            <p>{{ Auth::user()->name }}</p>

                            {{-- <p class="text-sm text-slate-500">{{ $doctor->Department->name }}</p> --}}
                        </div>
                    </div>
                    <div class="flex mt-5 justify-between">
                        <h1 class="font-semibold  text-sm self-center">Upcoming Appointments</h1>
                        <a href="{{ route('patient-appointments') }}" wire:navigate
                            class="self-center flex text-gray-400 font-semibold text-sm hover:text-indigo-600">
                            view all
                            <x-icon name="chevron-right" class="h-3 w-3 self-center" />
                        </a>
                    </div>

                    @if ($appointments->isEmpty())
                        <div class="mt-2  bg-red-100 rounded-lg p-3 flex flex-col justify-center items-center">
                            <img src="{{ asset('images/empty.png') }}" class="w-10 " alt="Empty appointment">
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
                                                class=" @if ($appointment->status == 'Confirmed') bg-green-200 @else bg-amber-200 @endif  p-2 self-center rounded-full">
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
                                                <span class="text-green-600">{{ $appointment->status }}</span>
                                            </p>

                                        </div>

                                        {{-- <a href="#" class="self-center underline text-red-500">Cancel</a> --}}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif

                    <div class="mt-5">
                        <a href="{{ route('new-appointment') }}" wire:navigate
                            class="bg-white  text-center self-center px-4 py-2 outline-none flex justify-center rounded-lg text-slate-600 ring-1 ring-slate-300  font-medium hover:bg-indigo-600 hover:text-white">
                            <x-icon name="plus" class="w-5  mr-2" />
                            New Appointment
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
