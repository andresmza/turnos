@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
        <form action="{{ route('doctors.store') }}" method="POST" class="w-full max-w-lg">
            @csrf

            <!-- Campos de Persona -->
            <div class="mb-4">
                <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Apellido:</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="document" class="block text-gray-700 text-sm font-bold mb-2">Documento:</label>
                <input type="text" name="document" id="document" value="{{ old('document') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña:</label>
                <input type="password" name="password" id="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="birth_date" class="block text-gray-700 text-sm font-bold mb-2">Fecha de Nacimiento:</label>
                <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Sexo:</label>
                <select name="gender" id="gender" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>

            <!-- Campos de Doctor -->
            <div class="mb-4">
                <label for="specialty_id" class="block text-gray-700 text-sm font-bold mb-2">Especialidad:</label>
                <select name="specialty_id" id="specialty_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="license_number" class="block text-gray-700 text-sm font-bold mb-2">Matrícula:</label>
                <input type="text" name="license_number" id="license_number" value="{{ old('license_number') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Guardar Doctor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
