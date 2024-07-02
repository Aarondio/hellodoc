@extends('layouts.app')

@section('content')

    <style>
        @media(prefers-color-scheme: dark) {
            .bg-dots {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(200,200,255,0.15)'/%3E%3C/svg%3E");
            }
        }

        @media(prefers-color-scheme: light) {
            .bg-dots {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,50,0.10)'/%3E%3C/svg%3E")
            }
        }
    </style>

    <div class=" bg-white bg-center ">

        @if (Route::has('login'))
            <div class="p-6 flex justify-between container mx-auto">
                <a href="/" class="font-semibold text-indigo-600 text-xl">ellodoc</a>
                <div class="hidden md:block">
                    <ul class="flex space-x-12">
                        <li><a href="/">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                        <li>
                            @auth
                                <a href="{{ route('patient-dashboard') }}"
                                    class=" text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Log
                                    in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Register</a>
                                @endif
                            @endauth
                        </li>
                    </ul>
                </div>

            </div>
        @endif



    </div>

    <section class="bg-indigo-50 py-12">
        <div class="container mx-auto py-12 text-center">
            <a href="{{ route('patient-dashboard') }}" class="bg-indigo-600 mb-4 rounded-full hover:bg-indigo-600 text-white px-4 py-2">Book
                Appointment</a>
            <h1 class="text-5xl font-bold mt-8">Welcome to ellodoc</h1>
            <h1 class="text-5xl font-bold">Manage all your appointments</h1>
            <h1 class="text-5xl font-bold">with ease</h1>
            <p class="text-slate-500 mt-3">Book and manage your appointment with our Doctors</p>
            <div class="flex justify-center mt-6">
                <img src="{{ asset('images/dashoaduser.png') }}" class="w-96 rounded-lg" alt="">
            </div>
        </div>
      <div class="flex justify-center">
        <a href="{{ route('doctor-login') }}" class="bg-green-600 mb-4 rounded-full hover:bg-green-700 text-white px-4 py-2">Doctors Login</a>
      </div>
    </section>

    {{-- <section>
        <div class="container mx-auto">
            <div class="flex justify-between">
                <h1 class="self-center text-4xl font-semibold">Ease to use user interface</h1>
                <img src="{{asset('images/dashoaduser.png')}}" class="w-1/2" alt="">
            </div>
        </div>
    </section> --}}

@endsection
