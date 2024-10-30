<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HealthInsuranceController;
use App\Http\Controllers\PatientController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/doctors', DoctorController::class)->parameters([
        'doctors' => 'doctor'
    ]);

    Route::resource('/patients', PatientController::class);
    Route::resource('/health-insurances', HealthInsuranceController::class)->parameters([
        'health-insurances' => 'healthInsurance'
    ]);
});
