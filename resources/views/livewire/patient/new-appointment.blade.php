<div class="mt-2 sm:mt-8">
    <div class="container mx-auto">
        <a class="my-3 ml-4 flex sm:hidden  text-indigo-600 underline text-md  cursor-pointer" onclick="history.back()">
            <x-icon name="arrow-left" class="h-4 w-4  self-center" />
            <span class="self-center">Back</span>
        </a>
        <div class="grid-cols-8 gap-4 lg:grid lg:px-12 px-4 mb-24">

            <div class="col-span-4  mt-6 ">

                <div class="border border-gray-200 bg-white p-6 col-span-6 rounded-lg">
                    {{-- <div class="py-6 px-6 col-span-6 "> --}}

                    <h1 class="mb-3 font-bold text-gray-900 mt-3">Book Appointment</h1>
                    <div>
                        <form wire:submit="create">
                            {{ $this->form }}
                            <button type="submit"
                                class="bg-indigo-600 px-5 py-2 rounded-md text-white hover:bg-indigo-700 mt-5 flex disabled:bg-indigo-300"
                                wire:loading.attr="disabled" wire:offline.attr="disabled">Book
                                Appointment
                                
                                <x-filament::loading-indicator class="h-5 w-5 text-white self-center ms-2"
                                    wire:loading /></button>

                            {{-- <span class="relative flex h-3 w-3 ml-3 self-center" wire:loading>
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gray-100 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
                                </span> --}}

                        </form>
                        <div wire:offline>
                           <p class="text-xm text-red-500"> Try and reconnect to internet to book appointment</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-span-4 mt-3">
                <div class="bg-white border border-gray-200 rounded-lg py-6 px-6 col-span-3 mt-3">
                    <div class="bg-yellow-50 p-4 rounded-md">
                        <p class="font-normal text-sm text-black">Your personal information will be visible to the
                            doctor. <strong>(Name,blood group,genotype, previous medical records)</strong></p>
                    </div>

                    <div class="mt-4 flex">
                        {{-- <img src="{{ asset('images/profilepix.jpeg') }}" class="h-16 w-16 rounded-full" /> --}}
                        <div class="self-center">

                            <p class="font-medium">{{ Auth::user()->name }}</p>

                            <p class="text-sm text-slate-500">Blood Group: <span
                                    class="font-bold">{{ Auth::user()->blood_group }}</span></p>
                            <p class="text-sm text-slate-500">Genotype: <span
                                    class="font-bold">{{ Auth::user()->genotype }}</span></p>
                        </div>
                    </div>
                    <div class="flex mt-5 justify-between">
                        <h1 class="font-semibold  text-sm self-center">Upcoming Appointments</h1>
                        <a href="{{ route('patient-appointments') }}"
                            class="self-center flex text-gray-400 font-semibold text-sm hover:text-indigo-600">
                            view all
                            <x-icon name="chevron-right" class="h-3 w-3 self-center" />
                        </a>
                    </div>

                    @if ($appointments->isEmpty())
                        <div class="mt-2  bg-red-100 rounded-lg p-3 flex flex-col justify-center items-center">
                            <img src="{{ asset('images/empty.png') }}" class="w-16 " alt="Empty appointment">
                            <p class="text-red-600 ">You have no upcoming appointment</p>
                        </div>
                    @else
                        @foreach ($appointments as $appointment)
                            <div class="mt-2 flex justify-between bg-neutral-50 rounded-lg p-3">
                                <div class="flex">
                                    <div class="bg-green-100 w-12 h-12 flex justify-center rounded-full">
                                        <x-icon name="clipboard" class="w-6 text-success-700" />
                                    </div>
                                    <div class="self-center ml-4">
                                        <p>{{ $appointment->doctor->name }}</p>
                                        <p class="text-sm text-slate-500">
                                            {{ $appointment->appointment_date->format('Y-m-d') }} <span
                                                class="text-red-600">By</span>
                                            {{ $appointment->appointment_time->format('H:i') }}</p>
                                    </div>
                                </div>

                                <a href="{{ route('pad', $appointment->id) }}" wire:navigate
                                    class="px-3 py-1 text-white rounded-full bg-green-600 text-sm self-center ring-2 ring-green-100 hover:bg-green-700 cursor-pointer">View</a>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
