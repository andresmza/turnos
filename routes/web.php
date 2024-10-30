<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ObraSocialController;
use App\Http\Controllers\PacienteController;
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

    Route::resource('/doctores', DoctorController::class)->parameters([
        'doctores' => 'doctor'
    ]);

    Route::resource('/pacientes', PacienteController::class);
    Route::resource('/obras-sociales', ObraSocialController::class)->parameters([
        'obras-sociales' => 'obraSocial'
    ]);







});
