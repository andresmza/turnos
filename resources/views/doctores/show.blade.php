@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Información del Doctor</h3>
        <p><strong>Nombre:</strong> {{ $doctor->persona->nombre }} {{ $doctor->persona->apellido }}</p>
        <p><strong>Documento:</strong> {{ $doctor->persona->documento }}</p>
        <p><strong>Email:</strong> {{ $doctor->persona->email }}</p>
        <p><strong>Teléfono:</strong> {{ $doctor->persona->telefono }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $doctor->persona->fecha_nacimiento }}</p>
        <p><strong>Sexo:</strong> {{ $doctor->persona->sexo }}</p>
        <p><strong>Especialidad:</strong> {{ $doctor->especialidad->nombre }}</p>
        <p><strong>Matrícula:</strong> {{ $doctor->matricula }}</p>

        <!-- Botón para editar -->
        <a href="{{ route('doctores.edit', $doctor) }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
            Editar
        </a>

        <!-- Botón para eliminar -->
        <form action="{{ route('doctores.destroy', $doctor) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirm('¿Estás seguro de querer eliminar este doctor?')">
                Eliminar
            </button>
        </form>
    </div>
</div>
@endsection