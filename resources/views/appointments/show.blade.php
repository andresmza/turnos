@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <h1 class="text-xl font-bold mb-4">Detalles del Turno</h1>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Paciente -->
                    <div>
                        <h2 class="text-lg font-semibold">Paciente</h2>
                        <p><strong>Nombre:</strong> {{ $appointment->patient->person->first_name }} {{ $appointment->patient->person->last_name }}</p>
                        <p><strong>Email:</strong> {{ $appointment->patient->person->email }}</p>
                        <p><strong>Teléfono:</strong> {{ $appointment->patient->person->phone }}</p>
                    </div>

                    <!-- Doctor -->
                    <div>
                        <h2 class="text-lg font-semibold">Doctor</h2>
                        <p><strong>Nombre:</strong> {{ $appointment->doctor->person->first_name }} {{ $appointment->doctor->person->last_name }}</p>
                        <p><strong>Especialidad:</strong> {{ $appointment->doctor->specialty->name }}</p>
                    </div>

                    <!-- Detalles del Turno -->
                    <div>
                        <h2 class="text-lg font-semibold">Detalles del Turno</h2>
                        <p><strong>Fecha:</strong> {{ $appointment->date }}</p>
                        <p><strong>Hora:</strong> {{ $appointment->start_time }}</p>
                        <p><strong>Duración:</strong> {{ $appointment->duration }}</p>
                        {{-- <p><strong>Estado:</strong> {{ $appointment->status }}</p> --}}
                    </div>
                </div>

                <!-- Botón para regresar a la lista de turnos -->
                <div class="mt-4">
                    <a href="{{ route('appointments.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Volver a la lista de turnos
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
