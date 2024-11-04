@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex justify-between mb-4">
                    <h1 class="text-xl font-bold">Editar Turno</h1>
                </div>

                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-6 mb-4">
                        <!-- Selección de Paciente -->
                        <div>
                            <label for="patient_id" class="block text-sm font-medium text-gray-700">Paciente</label>
                            <select id="patient_id" name="patient_id" class="form-select mt-1 block w-full" required>
                                <option value="">Seleccionar Paciente</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}"
                                        {{ $patient->id == $appointment->patient_id ? 'selected' : '' }}>
                                        {{ $patient->person->first_name }} {{ $patient->person->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selección de Especialidad -->
                        <div>
                            <label for="specialty_id" class="block text-sm font-medium text-gray-700">Especialidad</label>
                            <select id="specialty_id" name="specialty_id" class="form-select mt-1 block w-full" required>
                                <option value="">Seleccionar Especialidad</option>
                                @foreach ($specialties as $specialty)
                                    <option value="{{ $specialty->id }}"
                                        {{ $specialty->id == $appointment->doctor->specialty_id ? 'selected' : '' }}>
                                        {{ $specialty->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selección de Doctor -->
                        <div>
                            <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
                            <select id="doctor_id" name="doctor_id" class="form-select mt-1 block w-full" required>
                                <option value="">Seleccionar Doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ $doctor->id == $appointment->doctor_id ? 'selected' : '' }}>
                                        {{ $doctor->person->first_name }} {{ $doctor->person->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selección de Fecha -->
                        <div>
                            <label for="appointment_date" class="block text-sm font-medium text-gray-700">Día del
                                Turno</label>
                            <select id="appointment_date" name="appointment_date" class="form-select mt-1 block w-full"
                                required>
                                <option value="">Seleccionar Día</option>
                                @foreach ($availableDates as $date)
                                    <option value="{{ $date }}"
                                        {{ $date == $appointment->date ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selección de Horario -->
                        <div>
                            <label for="available_schedules" class="block text-sm font-medium text-gray-700">Horario
                                Disponible</label>
                            <select id="available_schedules" name="appointment_time" class="form-select mt-1 block w-full"
                                required
                                data-current-time="{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}">
                                <option value="">Seleccionar Horario</option>
                                @foreach ($availableSlots as $slot)
                                    <option value="{{ $slot['time'] }}"
                                        {{ $slot['time'] == \Carbon\Carbon::parse($appointment->start_time)->format('H:i') ? 'selected' : '' }}>
                                        {{ $slot['time'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const specialtySelect = document.getElementById('specialty_id');
        const doctorSelect = document.getElementById('doctor_id');
        const appointmentDateSelect = document.getElementById('appointment_date');
        const availableSchedulesSelect = document.getElementById('available_schedules');

        // Obtener el horario actual de la cita
        const currentAppointmentTime = availableSchedulesSelect.getAttribute('data-current-time');

        // Función para limpiar las opciones de un <select>
        function clearSelect(selectElement) {
            selectElement.innerHTML = '<option value="">Seleccionar</option>';
        }

        // Función para cargar los doctores de la especialidad seleccionada
        function loadDoctors() {
            const specialtyId = specialtySelect.value;
            clearSelect(doctorSelect);
            clearSelect(appointmentDateSelect);
            clearSelect(availableSchedulesSelect);

            if (specialtyId) {
                fetch(`/doctors/by-specialty/${specialtyId}`)
                    .then(response => response.json())
                    .then(doctors => {
                        doctors.forEach(doctor => {
                            const option = document.createElement('option');
                            option.value = doctor.id;
                            option.text = `${doctor.person.first_name} ${doctor.person.last_name}`;
                            doctorSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al obtener los doctores:', error));
            }
        }

        // Función para cargar las fechas disponibles para el doctor seleccionado
        function loadAvailableDates() {
            const doctorId = doctorSelect.value;
            clearSelect(appointmentDateSelect);
            clearSelect(availableSchedulesSelect);

            if (doctorId) {
                fetch(`/doctors/${doctorId}/available-days`)
                    .then(response => response.json())
                    .then(dates => {
                        dates.forEach(dateString => {
                            const option = document.createElement('option');
                            option.value = dateString;
                            option.text = dateString.split('-').reverse().join(
                            '-'); // Mostrar como DD-MM-YYYY
                            appointmentDateSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al obtener las fechas disponibles:', error));
            }
        }

        // Función para cargar los horarios disponibles para la fecha y el doctor seleccionados
        function loadAvailableSchedules() {
            const doctorId = doctorSelect.value;
            const selectedDate = appointmentDateSelect.value;
            clearSelect(availableSchedulesSelect);

            if (doctorId && selectedDate) {
                fetch(`/doctors/${doctorId}/available-schedules?date=${selectedDate}`)
                    .then(response => response.json())
                    .then(slots => {
                        let currentTimeIncluded = false;

                        slots.forEach(slot => {
                            const option = document.createElement('option');
                            option.value = slot.time;
                            option.text = slot.time;

                            if (slot.time === currentAppointmentTime) {
                                option.selected = true;
                                currentTimeIncluded = true;
                            }
                            availableSchedulesSelect.appendChild(option);
                        });

                        // Agregar la hora actual si no está en los horarios disponibles
                        // if (currentAppointmentTime && !currentTimeIncluded) {
                        //     const option = document.createElement('option');
                        //     option.value = currentAppointmentTime;
                        //     option.text = `${currentAppointmentTime} (Actual)`;
                        //     option.selected = true;
                        //     availableSchedulesSelect.appendChild(option);
                        // }
                    })
                    .catch(error => console.error('Error al obtener los horarios disponibles:', error));
            }
        }

        // Eventos de cambio para actualizar los selectores dependientes
        specialtySelect.addEventListener('change', loadDoctors);
        doctorSelect.addEventListener('change', loadAvailableDates);
        appointmentDateSelect.addEventListener('change', loadAvailableSchedules);
    });
</script>
