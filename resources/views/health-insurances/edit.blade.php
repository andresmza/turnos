@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Editar Obra Social</h3>

            <!-- Formulario para editar -->
            <form action="{{ route('health-insurances.update', $healthInsurance->id) }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')

                <!-- Campo de Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Obra Social:</label>
                    <input type="text" name="name" id="name" value="{{ $healthInsurance->name }}" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Contenedor de los botones en la misma línea -->
                <div class="flex space-x-4 mt-4">
                    <!-- Botón para editar -->
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Editar
                    </button>

                    <!-- Botón para eliminar (dentro del mismo formulario) -->
                    <form action="{{ route('health-insurances.destroy', $healthInsurance->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta obra social?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Eliminar
                        </button>
                    </form>

                    <!-- Botón para volver -->
                    <a href="{{ route('health-insurances.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
