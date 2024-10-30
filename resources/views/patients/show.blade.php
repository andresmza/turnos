@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-2xl font-bold mb-4">Detalles del Paciente</h1>
            <div class="mb-4">
                <h2 class="text-xl font-semibold">Información Personal</h2>
                <p><strong>Nombre:</strong> {{ $patient->person->first_name }} {{ $patient->person->last_name }}</p>
                <p><strong>Documento:</strong> {{ $patient->person->document }}</p>
                <p><strong>Email:</strong> {{ $patient->person->email }}</p>
                <p><strong>Teléfono:</strong> {{ $patient->person->phone }}</p>
                <p><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($patient->person->birth_date)->format('d-m-Y') }}</p>
                <p><strong>Sexo:</strong> {{ $patient->person->gender == 'M' ? 'Masculino' : 'Femenino' }}</p>
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-semibold">Información de Salud</h2>
                <p><strong>Obra Social:</strong> {{ $patient->healthInsurance ? $patient->healthInsurance->name : 'No Asignada' }}</p>
                <p><strong>Número de Afiliado:</strong> {{ $patient->affiliate_number }}</p>
            </div>

            <!-- Botón para editar -->
            <a href="{{ route('patients.edit', $patient->id) }}"
                class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Editar
            </a>

            <!-- Botón para eliminar -->
            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150"
                    onclick="return confirm('¿Estás seguro de querer eliminar este paciente?')">
                    Eliminar
                </button>
            </form>

            <!-- Botón para volver -->
            <a href="{{ route('patients.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-2">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection
