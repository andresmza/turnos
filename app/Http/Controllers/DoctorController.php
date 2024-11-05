<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialty;
use App\Models\Person;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('person')->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $patients = Patient::all();
        $specialties = Specialty::all();
        $doctors = Doctor::all();

        return view('doctors.create', compact('patients', 'specialties', 'doctors'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Crear el usuario
            $user = new User();
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            // Crear la persona
            $person = new Person();
            $person->first_name = $request->first_name;
            $person->last_name = $request->last_name;
            $person->document = $request->document;
            $person->email = $request->email;
            $person->phone = $request->phone;
            $person->birth_date = $request->birth_date;
            $person->gender = $request->gender;
            $person->save();

            // Crear el doctor
            $doctor = new Doctor();
            $doctor->user_id = $user->id;
            $doctor->person_id = $person->id;
            $doctor->specialty_id = $request->specialty_id;
            $doctor->license_number = $request->license_number;
            $doctor->save();

            DB::commit();

            return redirect()->route('doctors.index');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'Hubo un error al crear el doctor.'])->withInput();
        }
    }

    public function show($id)
    {
        $doctor = Doctor::with(['person', 'specialty'])->find($id);
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $doctor->load(['person', 'specialty']);
        // dd($doctor);
        return view('doctors.edit', compact('doctor'), [
            'specialties' => Specialty::all(),
        ]);
    }

    public function update(Request $request, Doctor $doctor)
    {
        // Log::info('test');
        // dd($request);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'document' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required|in:M,F',
            'specialty_id' => 'required|exists:specialties,id',
            'license_number' => 'required',
        ]);
        DB::beginTransaction();
        Log::info(0);

        try {
            $user = $doctor->user;
            $user->name = $request->first_name;
            $user->email = $request->email;
            $user->save();
            Log::info(1);
            // Update Person
            $person = $doctor->person;
            $person->first_name = $request->first_name;
            $person->last_name = $request->last_name;
            $person->document = $request->document;
            $person->email = $request->email;
            $person->phone = $request->phone;
            $person->birth_date = $request->birth_date;
            $person->gender = $request->gender;
            $person->save();
            Log::info(2);

            // Update Doctor
            $doctor->specialty_id = $request->specialty_id;
            $doctor->license_number = $request->license_number;
            // dump($doctor->license_number);
            Log::info(3);
            Log::info($doctor->licence_number);
            $doctor->save();
            Log::info($doctor->licence_number);

            DB::commit();
            return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return back()->withErrors(['msg' => 'There was an error updating the doctor.'])->withInput();
        }
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect()->route('doctors.index');
    }

    public function getDoctorsBySpecialty($specialtyId)
    {
        $doctors = Doctor::where('specialty_id', $specialtyId)
            ->with('person')
            ->get();

        return response()->json($doctors);
    }

    public function getSchedules(Request $request, Doctor $doctor)
    {
        $date = $request->query('date'); // Fecha seleccionada
        $schedules = $doctor->schedules()->where('date', $date)->get(['id', 'start_time', 'end_time', 'appointment_duration']);

        $availableSlots = [];

        foreach ($schedules as $schedule) {
            $startTime = Carbon::parse($schedule->start_time);
            $endTime = Carbon::parse($schedule->end_time);
            $duration = $schedule->appointment_duration;

            while ($startTime->lt($endTime)) {
                $availableSlots[] = [
                    'id' => $schedule->id,  // Incluye el ID del horario
                    'time' => $startTime->format('H:i'),  // Incluye la hora en texto
                ];
                $startTime->addMinutes($duration);
            }
        }

        return response()->json($availableSlots);
    }

    public function getAvailableDays($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);

        // Obtener fechas únicas desde `clinic_schedules` donde el doctor tiene horarios disponibles
        $availableDays = $doctor->schedules()
            ->join('clinic_schedules', 'doctor_schedules.clinic_schedule_id', '=', 'clinic_schedules.id')
            ->select('clinic_schedules.date')
            ->distinct()
            ->where('clinic_schedules.date', '>=', now()->toDateString()) // Solo fechas futuras o actuales
            ->orderBy('clinic_schedules.date')
            ->get()
            ->pluck('date');

        return response()->json($availableDays);
    }

    public function getAvailableSchedules(Request $request, $doctorId)
{
    $date = $request->query('date'); // Fecha seleccionada
    $doctor = Doctor::findOrFail($doctorId);

    // Obtener los horarios del doctor para la fecha seleccionada usando `clinic_schedules.date`
    $schedules = $doctor->schedules()
        ->join('clinic_schedules', 'doctor_schedules.clinic_schedule_id', '=', 'clinic_schedules.id')
        ->where('clinic_schedules.date', $date)
        ->get(['doctor_schedules.id', 'doctor_schedules.start_time', 'doctor_schedules.end_time', 'doctor_schedules.appointment_duration']);

    // Obtener los horarios ya reservados en appointments para el doctor y la fecha seleccionada
    $reservedTimes = $doctor->appointments()
        ->where('date', $date)
        ->pluck('start_time')
        ->map(function ($time) {
            return Carbon::parse($time)->format('H:i'); // Formatear a H:i para la comparación
        })
        ->toArray();

    $availableSlots = [];

    // Crear los horarios disponibles excluyendo los ya reservados
    foreach ($schedules as $schedule) {
        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);
        $duration = $schedule->appointment_duration;

        while ($startTime->lt($endTime)) {
            $timeSlot = $startTime->format('H:i'); // Aseguramos formato H:i

            // Verificar si el horario ya está reservado
            if (!in_array($timeSlot, $reservedTimes, true)) {  // Comparación estricta con `true`
                $availableSlots[] = [
                    'id' => $schedule->id,  // ID del horario
                    'time' => $timeSlot,    // Hora en formato H:i
                ];
            }

            // Incrementar el horario según la duración
            $startTime->addMinutes($duration);
        }
    }

    return response()->json($availableSlots);
}

}
