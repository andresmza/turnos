@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-2xl font-bold mb-4">Detalles del Paciente</h1>
            <div class="mb-4">
                <h2 class="text-xl font-semibold">Información Personal</h2>
                <p><strong>Nombre:</strong> {{ $paciente->persona->nombre }} {{ $paciente->persona->apellido }}</p>
                <p><strong>Documento:</strong> {{ $paciente->persona->documento }}</p>
                <p><strong>Email:</strong> {{ $paciente->persona->email }}</p>
                <p><strong>Teléfono:</strong> {{ $paciente->persona->telefono }}</p>
                <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->persona->fecha_nacimiento }}</p>
                <p><strong>Sexo:</strong> {{ $paciente->persona->sexo == 'M' ? 'Masculino' : 'Femenino' }}</p>
            </div>
            <div class="mb-4">
                <h2 class="text-xl font-semibold">Información de Salud</h2>
                <p><strong>Obra Social:</strong> {{ $paciente->obraSocial ? $paciente->obraSocial->nombre : 'No Asignada' }}</p>
                <p><strong>Número de Afiliado:</strong> {{ $paciente->numero_afiliado }}</p>
            </div>
            <a href="{{ route('pacientes.edit', $paciente->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Editar
            </a>
            <a href="{{ route('pacientes.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection