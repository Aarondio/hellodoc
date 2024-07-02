<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
</head>

<body class="antialiased">
    <div class="grid grid-cols-12 h-full">
        <div class="col-span-2 h-svh border-r-2 text-white border-r-gray-100 bg-indigo-600 py-6  hidden lg:block ">
            <span class="border-1 ml-6 border-red-200 ring-1 ring-white pt-2 px-1 rounded-sm">
                <a href="#" class="" class="">
                    <span class="font-bold text-3xl">ello</span><span class="text-xl text-green-200">Doc</span>
                </a>
            </span>
             
      
                <ul class="space-y-1 flex flex-col  w-full mt-20">
                    <li class="{{  Route::is('doctor-dashboard')? 'bg-indigo-500' : '' }} pl-6 py-3 text-white font-semibold text-sm flex"> <x-icon name="home" class="h-5 w-5 self-center"/> <a href="{{route('doctor-dashboard')}}" wire:navigate class="self-center ml-2">Home</a></li>
                    <li class="{{  Route::is('dad')? 'bg-indigo-500' : '' }} pl-6 py-3 text-white font-semibold text-sm flex"> <x-icon name="clipboard" class="h-5 w-5 self-center"/> <a href="{{ route('dad') }}" wire:navigate class="self-center ml-2">Appointment</a></li>
                    <li class="{{  Route::is('das')? 'bg-indigo-500' : '' }} pl-6 py-3 text-white font-semibold text-sm flex"> <x-icon name="user" class="h-5 w-5 self-center"/> <a href="{{ route('das') }}" wire:navigate class="self-center ml-2">Profile</a></li>
                


                </ul>
           
        </div>
        <div class="col-span-12 h-scree lg:col-span-10">
            <nav class="bg-gray-100 py-2 px-4">
                <div class="container flex justify-between mx-auto">
                    <a href="{{ route('home') }}">
                        <x-logo class="w-[120px] h-16 mx-auto text-indigo-600" />
                    </a>

                    <ul class="self-center space-x-8 hidden md:flex">
                        <li> <a href="#">Home</a></li>
                        <li> <a href="#">Records</a></li>
                        <li> <a href="#">Appointments</a></li>
                        @auth
                            <li> <a href="{{ route('new-appointment') }}" wire:navigate
                                    class="bg-indigo-600 text-white px-6 py-3 rounded-full hover:bg-indigo-700">New
                                    Appointment</a></li>
                        @endauth

                    </ul>
                    <x-icon name="menu" class="w-6 md:hidden" />
                </div>
            </nav>
            {{ $slot }}
        </div>
    </div>



    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
