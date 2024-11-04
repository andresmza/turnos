<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HealthInsuranceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Doctor routes
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
    Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('/doctors/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
    Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::get('/doctors/{doctor}/schedules', [DoctorController::class, 'getSchedules']);
    Route::get('/doctors/by-specialty/{specialtyId}', [DoctorController::class, 'getDoctorsBySpecialty']);
    Route::get('/doctors/{doctor}/available-schedules', [DoctorController::class, 'getAvailableSchedules']);
    Route::get('/doctors/{doctor}/available-days', [DoctorController::class, 'getAvailableDays']);

    // Patient routes
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

    // Health Insurance routes
    Route::get('/health-insurances', [HealthInsuranceController::class, 'index'])->name('health-insurances.index');
    Route::get('/health-insurances/create', [HealthInsuranceController::class, 'create'])->name('health-insurances.create');
    Route::post('/health-insurances', [HealthInsuranceController::class, 'store'])->name('health-insurances.store');
    Route::get('/health-insurances/{healthInsurance}', [HealthInsuranceController::class, 'show'])->name('health-insurances.show');
    Route::get('/health-insurances/{healthInsurance}/edit', [HealthInsuranceController::class, 'edit'])->name('health-insurances.edit');
    Route::put('/health-insurances/{healthInsurance}', [HealthInsuranceController::class, 'update'])->name('health-insurances.update');
    Route::delete('/health-insurances/{healthInsurance}', [HealthInsuranceController::class, 'destroy'])->name('health-insurances.destroy');

    // Appointment routes
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::patch('/appointments/{appointment}/attend', [AppointmentController::class, 'markAsAttended'])->name('appointments.attend');
});
