<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Doctor\Login as DoctorLogin;
use App\Livewire\Auth\Doctor\Register as DoctorRegister;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\Doctor\AccountSetup;
use App\Livewire\Doctor\AppointmentDetails;
use App\Livewire\Doctor\Appointments;
use App\Livewire\Doctor\AppointmentsHistory;
use App\Livewire\Doctor\DoctorDashboard;
use App\Livewire\Doctor\PendingAppointments;
use App\Livewire\Doctor\UpcomingAppointments;
use App\Livewire\Homepage;
use App\Livewire\Patient\AppointmentHistory;
use App\Livewire\Patient\AppointmentsDetails;
use App\Livewire\Patient\DoctorSearch;
use App\Livewire\Patient\EditProfile;
use App\Livewire\Patient\NewAppointment;
use App\Livewire\Patient\PatientAppointments;
use App\Livewire\Patient\PatientDashboard;
use App\Livewire\Patient\PendingAppointment;
use App\Livewire\Patient\Reschedule;
use App\Livewire\Patient\UpcomingAppointment;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {

    Route::get('login', Login::class)
        ->name('login');
        
    Route::get('doctor/login', DoctorLogin::class)
        ->name('doctor-login');
    Route::get('doctor/register', DoctorRegister::class)
        ->name('doctor-register');
    Route::get('register', Register::class)
        ->name('register');
});


Route::get('password/reset', Email::class)
    ->name('password.request');
Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');
    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('logout', LogoutController::class)
        ->name('logout');
});





Route::middleware(['auth'])->group(function () {
    Route::get('patient-dashboard', PatientDashboard::class)->name('patient-dashboard');
    Route::get('new-appointment', NewAppointment::class)->name('new-appointment');
    Route::get('doctor-search', DoctorSearch::class)->name('doctor-search');
    Route::get('edit-profile', EditProfile::class)->name('edit-profile');
    Route::get('patient-appointments', PatientAppointments::class)->name('patient-appointments');
    Route::get('history', AppointmentHistory::class)->name('history');
    Route::get('upcoming', UpcomingAppointment::class)->name('upcoming');
    Route::get('pending', PendingAppointment::class)->name('pending');


    Route::delete('appointment/{id}', AppointmentsDetails::class);
    Route::get('reschedule/{id}', Reschedule::class)->name('reschedule');
    Route::get('appointments-details/{id}', AppointmentsDetails::class)->name('pad');



    Route::get('doctor-list', function () {
        return response()->json(User::all());
    })->name('doctor-list');
});


Route::prefix('doctor')->group(function () {
    Route::middleware(['auth.doctor'])->group(function () {
        Route::get('dashboard', DoctorDashboard::class)->name('doctor-dashboard');
        Route::get('appointment/{id}', AppointmentDetails::class)->name('dad');
        Route::get('account-setup', AccountSetup::class)->name('das');
        Route::get('appointments', Appointments::class)->name('doctor-appointments');
        Route::get('history', AppointmentsHistory::class)->name('appointments-history');
        Route::get('pending', PendingAppointments::class)->name('pending-appointments');
        Route::get('upcoming', UpcomingAppointments::class)->name('upcoming-appointments');

        Route::post('doclogout', LogoutController::class)
            ->name('doclogout');
    });
});
