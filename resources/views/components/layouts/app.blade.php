<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8" />

    <meta name="application-name" content="{{ config('app.name') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>


    @filamentStyles
    @vite('resources/css/app.css')
    {{-- @livewireScriptConfig --}}

</head>

<body class="antialiased relative bg-neutral-100">
    {{-- <div class="grid grid-cols-12 fixed w-screen"> --}}
    <div class="flex fixed w-screen">
        <div
            class="w-72 h-svh border-r-2 text-white border-r-gray-100 bg-indigo-600 py-2 hidden lg:flex flex-col justify-between">
            <div>
                <span class="border-1 ml-6 border-red-200 ring-1 ring-white pt-2 px-1 rounded-sm self-start">
                    <a href="{{ route('patient-dashboard') }}" class="" wire:navigate>
                        <span class="font-bold text-3xl">ello</span><span class="text-xl text-green-200">Doc</span>
                    </a>
                </span>

                <ul class="space-y-1 flex flex-col  w-full mt-20">
                    <li
                        class="{{ Route::is('patient-dashboard') ? 'bg-indigo-500' : '' }} pl-6 py-3 text-white font-semibold text-sm flex">
                        <x-icon name="home" class="h-5 w-5 self-center" /> <a href="{{ route('patient-dashboard') }}"
                            wire:navigate class="self-center ml-2">Home</a>
                    </li>
                    <li
                        class="{{ Route::is('new-appointment') ? 'bg-indigo-500' : '' }} pl-6 py-3 text-white font-semibold text-sm flex">
                        <x-icon name="plus-circle" class="h-5 w-5 self-center" /> <a href="{{ route('new-appointment') }}"
                            wire:navigate class="self-center ml-2">Book</a>
                    </li>
                    <li
                        class="{{ Route::is('patient-appointments') ? 'bg-indigo-500' : '' }} pl-6 py-3 text-white font-semibold text-sm flex">
                        <x-icon name="document-text" class="h-5 w-5 self-center" /> <a
                            href="{{ route('patient-appointments') }}" wire:navigate
                            class="self-center ml-2">Appointments</a>
                    </li>
                    <li
                        class="{{ Route::is('doctor-search') ? 'bg-indigo-500' : '' }} pl-6 py-3 text-white font-semibold text-sm flex">
                        <x-icon name="search" class="h-5 w-5 self-center" /> <a
                            href="{{ route('doctor-search') }}" wire:navigate
                            class="self-center ml-2">Doctor search</a>
                    </li>

                    <li
                        class="{{ Route::is('history') ? 'bg-indigo-500' : '' }} pl-6 py-3 text-white font-semibold text-sm flex">
                        <x-icon name="archive" class="h-5 w-5 self-center" /> <a href="{{ route('history') }}"
                            wire:navigate class="self-center ml-2">History</a>
                    </li>
                    <li
                        class="{{ Route::is('edit-profile') ? 'bg-indigo-500' : '' }} pl-6 py-3 text-white font-semibold text-sm flex">
                        <x-icon name="user" class="h-5 w-5 self-center" /> <a href="{{ route('edit-profile') }}"
                            wire:navigate class="self-center ml-2">Profile</a>
                    </li>



                </ul>
      
            </div>

            <div class="mx-6 py-8">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex font-normal hover:text-red-200"><span>Logouts</span> <x-icon name="logout"
                        class="h-5 w-5 ml-2 self-center" /> </button>
                </form>
               
            </div>
        </div>
        {{-- <div class="col-span-12  lg:col-span-10 "> --}}
        <div class="w-full">
            <nav class="shadow-sm py-4 px-4 backdrop-blur bg-white">
                <div class="container flex justify-between mx-auto">
                    <x-icon name="menu" class="h-5 w-5" />

                    <ul class="self-center space-x-8 hidden md:flex">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex font-normal hover:text-red-200"><span>Logouts</span> <x-icon name="logout"
                                    class="h-5 w-5 ml-2 self-center" /> </button>
                            </form>
                            </li>



                    </ul>
                    <x-icon name="menu" class="w-6 md:hidden" />
                </div>
            </nav>

            <div class="h-screen overflow-y-auto">
                {{ $slot }}
            </div>

        </div>
    </div>


    @livewire('notifications')
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
