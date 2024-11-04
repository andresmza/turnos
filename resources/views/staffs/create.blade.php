@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
        <form action="{{ route('staffs.store') }}" method="POST" class="w-full max-w-lg">
            @csrf

            <!-- Campo de Persona -->
            <div class="mb-4">
                <label for="person_id" class="block text-gray-700 text-sm font-bold mb-2">Persona:</label>
                <select name="person_id" id="person_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($people as $person)
                        <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Campo de Posición -->
            <div class="mb-4">
                <label for="position_id" class="block text-gray-700 text-sm font-bold mb-2">Posición:</label>
                <select name="position" id="position_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($positions as $position)
                        <option value="{{ $position->name }}">{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Guardar Staff
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
