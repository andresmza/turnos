<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\ClinicSchedule;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Patient;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        // dd($user->doctor, $user->staff, isset($user->staff));
        // Si el usuario está relacionado con la tabla `doctor`
        if ($user->doctor) {
            // Mostrar solo las citas de este doctor, en estado no atendido (status = 0)
            $appointments = Appointment::with(['patient.person', 'doctor', 'medicalOffice'])
                ->where('doctor_id', $user->doctor->id)
                ->where('status', 0) // Estado 0 para "no atendido"
                ->orderBy('date', 'asc')
                ->orderBy('start_time', 'asc')
                ->get();
        }
        // Si el usuario está relacionado con la tabla `staff`
        elseif ($user->staff) {
            // Mostrar todas las citas en estado no atendido (status = 0)
            $appointments = Appointment::with(['patient.person', 'doctor.person', 'medicalOffice'])
                ->where('status', 0) // Estado 0 para "no atendido"
                ->orderBy('date', 'asc')
                ->orderBy('start_time', 'asc')
                ->get();
        }
        // Si el usuario no es ni doctor ni staff, redirigir o mostrar un error
        else {
            abort(403, 'No tiene permiso para ver esta página.');
        }

        // Obtener los doctores y especialidades (para mostrarlos en filtros o selección si es necesario en la vista)
        $doctors = Doctor::with('person')->get();
        $specialties = Specialty::all();

        return view('appointments.index', [
            'user' => $user,
            'appointments' => $appointments,
            'doctors' => $doctors,
            'specialties' => $specialties
        ]);
    }
    public function store(Request $request)
    {
        // Decodificar el JSON de `available_schedule`
        $availableSchedule = json_decode($request->input('available_schedule'), true);

        // Validar que `available_schedule` se haya decodificado correctamente
        if (json_last_error() !== JSON_ERROR_NONE || !isset($availableSchedule['schedule_id'], $availableSchedule['time'])) {
            return redirect()->back()->withErrors('El formato de horario seleccionado no es válido.')->withInput();
        }

        // Agregar los valores decodificados al request para poder validarlos
        $request->merge([
            'schedule_id' => $availableSchedule['schedule_id'],
            'appointment_time' => $availableSchedule['time'],
        ]);

        // Validar todos los campos
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'specialty_id' => 'required|exists:specialties,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'schedule_id' => 'required|exists:doctor_schedules,id',
            'appointment_time' => 'required|date_format:H:i',
        ]);

        $doctor_schedule = DoctorSchedule::findOrFail($validated['schedule_id']);
        $clinic_schedule = ClinicSchedule::findOrFail($doctor_schedule->clinic_schedule_id);
        // dd($clinic_schedule);
        // Ahora puedes usar los valores validados
        $appointmentDate = Carbon::parse($validated['appointment_date'])->format('Y-m-d');

        $start_time = $validated['appointment_time'];
        $end_time = Carbon::parse($start_time)->addMinutes($doctor_schedule->appointment_duration)->format('H:i'); // Ajusta la duración según tu lógica
        // dd([
        //     'patient_id' => (int) $validated['patient_id'],
        //         'doctor_id' => (int) $validated['doctor_id'],
        //         'medical_office_id' => $clinic_schedule->medical_office_id,
        //         'staff_id' => auth()->user()->id,
        //         'date' => $validated['appointment_date'],
        //         'start_time' => $start_time,
        //         'end_time' => $end_time,
        //         'status' => 1,
        // ]);

        // Crear la cita
        $appointment = Appointment::create([
            'patient_id' => $validated['patient_id'],
            'doctor_id' => $validated['doctor_id'],
            'medical_office_id' => $clinic_schedule->medical_office_id,
            'staff_id' => auth()->user()->staff->id,
            'date' => $appointmentDate,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => 1,
            // 'specialty_id' => $validated['specialty_id'],
            // 'schedule_id' => $validated['schedule_id'],
        ]);

        return redirect()->route('appointments.index')->with('success', 'Cita creada exitosamente');
    }


    public function show($id)
    {
        $appointment = Appointment::with(['patient.person', 'doctor.person'])->findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }


    public function create()
    {
        $doctors = Doctor::with('person')->get();
        $patients = Patient::with('person')->get();
        $specialties = Specialty::specialtyWithDoctors();

        return view('appointments.create', compact('doctors', 'patients', 'specialties'));
    }


    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Obtener todos los pacientes y especialidades
        $patients = Patient::all();
        $specialties = Specialty::all();

        // Obtener doctores de la especialidad actual
        $doctors = Doctor::where('specialty_id', $appointment->doctor->specialty_id)->get();

        // Obtener fechas disponibles para el doctor actual desde clinic_schedules
        $availableDates = DB::table('clinic_schedules')
            ->join('doctor_schedules', 'clinic_schedules.id', '=', 'doctor_schedules.clinic_schedule_id')
            ->where('doctor_schedules.doctor_id', $appointment->doctor_id)
            ->where('clinic_schedules.date', '>=', now()->toDateString())
            ->distinct()
            ->pluck('clinic_schedules.date')
            ->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m-d'); // Formato `Y-m-d` para el select
            });

        // Obtener horarios disponibles para la fecha y doctor actuales desde clinic_schedules
        $availableSlots = [];
        $schedules = DB::table('clinic_schedules')
            ->join('doctor_schedules', 'clinic_schedules.id', '=', 'doctor_schedules.clinic_schedule_id')
            ->where('doctor_schedules.doctor_id', $appointment->doctor_id)
            ->where('clinic_schedules.date', $appointment->date)
            ->select('doctor_schedules.id', 'doctor_schedules.start_time', 'doctor_schedules.end_time', 'doctor_schedules.appointment_duration')
            ->get();

        foreach ($schedules as $schedule) {
            $startTime = Carbon::parse($schedule->start_time);
            $endTime = Carbon::parse($schedule->end_time);
            $duration = $schedule->appointment_duration;

            while ($startTime->lt($endTime)) {
                $availableSlots[] = [
                    'id' => $schedule->id,
                    'time' => $startTime->format('H:i'),
                ];
                $startTime->addMinutes($duration);
            }
        }

        return view('appointments.edit', compact('appointment', 'patients', 'specialties', 'doctors', 'availableDates', 'availableSlots'));
    }



    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'specialty_id' => 'required|exists:specialties,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
        ]);

        // Verificar si el horario está disponible antes de actualizar
        $isReserved = Appointment::where('doctor_id', $validated['doctor_id'])
            ->where('date', $validated['appointment_date'])
            ->where('start_time', $validated['appointment_time'])
            ->where('id', '!=', $appointment->id)
            ->exists();

        if ($isReserved) {
            return redirect()->back()->withErrors('Este horario ya está reservado. Elige otro horario.');
        }

        // Actualizar la cita
        $appointment->update([
            'patient_id' => $validated['patient_id'],
            'doctor_id' => $validated['doctor_id'],
            'date' => $validated['appointment_date'],
            'start_time' => $validated['appointment_time'],
            'end_time' => Carbon::parse($validated['appointment_time'])->addMinutes(30)->format('H:i'),
            'status' => $request->input('status', $appointment->status),
        ]);

        return redirect()->route('appointments.index')->with('success', 'Cita actualizada exitosamente.');
    }


    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(null, 204);
    }

    public function markAsAttended($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        $appointment->status = true;
        $appointment->save();

        return redirect()->back()->with('success', 'El turno ha sido marcado como atendido.');
    }
}
