@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form action="{{ route('pacientes.update', $paciente) }}" method="POST" class="w-full max-w-lg">
                @csrf
                @method('PUT')

                <!-- Campos de Persona -->
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="{{ $paciente->persona->nombre }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="apellido" class="block text-gray-700 text-sm font-bold mb-2">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" value="{{ $paciente->persona->apellido }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="documento" class="block text-gray-700 text-sm font-bold mb-2">Documento:</label>
                    <input type="text" name="documento" id="documento" value="{{ $paciente->persona->documento }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" value="{{ $paciente->persona->email }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" value="{{ $paciente->persona->telefono }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="fecha_nacimiento" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $paciente->persona->fecha_nacimiento }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="sexo" class="block text-gray-700 text-sm font-bold mb-2">Sexo:</label>
                    <select name="sexo" id="sexo" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="M" @if($paciente->persona->sexo == 'M') selected @endif>Masculino</option>
                        <option value="F" @if($paciente->persona->sexo == 'F') selected @endif>Femenino</option>
                    </select>
                </div>

                <!-- Campos de Paciente -->
                <div class="mb-4">
                    <label for="obra_social_id" class="block text-gray-700 text-sm font-bold mb-2">Obra Social:</label>
                    <select name="obra_social_id" id="obra_social_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach($obrasSociales as $obraSocial)
                            <option value="{{ $obraSocial->id }}" @if($paciente->obra_social_id == $obraSocial->id) selected @endif>{{ $obraSocial->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="numero_afiliado" class="block text-gray-700 text-sm font-bold mb-2">Número Afiliado:</label>
                    <input type="text" name="numero_afiliado" id="numero_afiliado" value="{{ $paciente->numero_afiliado }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Actualizar Paciente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection