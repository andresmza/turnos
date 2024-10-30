@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex justify-between mb-4">
                    <h1 class="text-xl font-bold">Lista de Pacientes</h1>
                    <a href="{{ route('pacientes.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Agregar Paciente
                    </a>
                </div>

                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Nombre</th>
                            <th class="py-3 px-6 text-center">Edad</th>
                            <th class="py-3 px-6 text-center">Teléfono</th>
                            <th class="py-3 px-6 text-left">Obra Social</th>
                            <th class="py-3 px-6 text-center">Número Afiliado</th>
                            <th class="py-3 px-6 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($pacientes as $paciente)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    {{ $paciente->persona->nombre }} {{ $paciente->persona->apellido }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ \Carbon\Carbon::parse($paciente->persona->fecha_nacimiento)->age }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $paciente->persona->telefono }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ $paciente->obraSocial->nombre }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $paciente->numero_afiliado }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="{{ route('pacientes.show', $paciente->id) }}"
                                            class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pacientes.edit', $paciente->id) }}"
                                            class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de querer eliminar este paciente?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-4 transform hover:text-red-500 hover:scale-110">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@if (session('success'))
    <div class="toast p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="toast p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>
    .toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(toast => {
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(),
                600);
            }, 3000);
        });
    });
</script>
