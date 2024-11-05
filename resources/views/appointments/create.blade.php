@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex justify-between mb-4">
                    <h1 class="text-xl font-bold">Agendar Turno</h1>
                </div>

                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 mb-4">
                        <!-- Selección de Paciente -->
                        <div>
                            <label for="patient_id" class="block text-sm font-medium text-gray-700">Paciente</label>
                            <select id="patient_id" name="patient_id" class="form-select mt-1 block w-full" required>
                                <option value="">Seleccionar Paciente</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">
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
                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Selección de Doctor -->
                        <div>
                            <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
                            <select id="doctor_id" name="doctor_id" class="form-select mt-1 block w-full" required>
                                <option value="">Seleccionar Doctor</option>
                                <!-- Aquí se cargarán los doctores mediante JavaScript -->
                            </select>
                        </div>

                        <!-- Selección de Día del Turno -->
                        <div>
                            <label for="appointment_date" class="block text-sm font-medium text-gray-700">Día del
                                Turno</label>
                            <select id="appointment_date" name="appointment_date" class="form-select mt-1 block w-full"
                                required>
                                <option value="">Seleccionar Día</option>
                                <!-- Los días disponibles se cargarán aquí mediante JavaScript -->
                            </select>
                        </div>

                        <!-- Selección de Horario Disponible -->
                        <div>
                            <label for="available_schedules" class="block text-sm font-medium text-gray-700">Horario
                                Disponible</label>
                            <select id="available_schedules" name="available_schedule" class="form-select mt-1 block w-full"
                                required>
                                <option value="">Seleccionar Horario</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Agendar Turno
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/appointments/create.js')}}" ></script>
