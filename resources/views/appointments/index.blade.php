@extends('layouts.app')

@section('content')
    {{-- {{dd(isset($user))}} --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-xl font-bold">Listado de Turnos</h1>
                    @if ($user->staff)
                        <a href="{{ route('appointments.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Nuevo Turno
                        </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b text-left">Paciente</th>
                                <th class="px-4 py-2 border-b text-left">Doctor</th>
                                <th class="px-4 py-2 border-b text-left">Fecha</th>
                                <th class="px-4 py-2 border-b text-left">Hora</th>
                                <th class="px-4 py-2 border-b text-left">Duración</th>
                                <th class="px-4 py-2 border-b text-left">Consultorio</th>
                                <th class="px-4 py-2 border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td class="px-4 py-2 border-b">
                                        {{ $appointment->patient->person->first_name }}
                                        {{ $appointment->patient->person->last_name }}
                                    </td>
                                    <td class="px-4 py-2 border-b">
                                        {{ $appointment->doctor->person->first_name }}
                                        {{ $appointment->doctor->person->last_name }}
                                    </td>
                                    <td class="px-4 py-2 border-b">
                                        {{ $appointment->date }}
                                    </td>
                                    <td class="px-4 py-2 border-b">
                                        {{ $appointment->start_time }}
                                    </td>
                                    <td class="px-4 py-2 border-b">
                                        {{ $appointment->duration }}
                                    </td>
                                    <td class="px-4 py-2 border-b">
                                        {{ $appointment->medicalOffice->number }}
                                    </td>
                                    <td class="px-4 py-2 border-b text-center">
                                        <a href="{{ route('appointments.show', $appointment->id) }}"
                                            class="text-blue-500 hover:underline" title="Ver">
                                            <i class="fas fa-eye"></i></a>
                                        @if ($user->staff)
                                            <a href="{{ route('appointments.edit', $appointment->id) }}"
                                                class="ml-2 text-green-500 hover:underline" title="Editar">
                                                <i class="fas fa-edit"></i></a>
                                            <form action="{{ route('appointments.destroy', $appointment->id) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline ml-2"
                                                    onclick="return confirm('¿Está seguro de que desea eliminar este turno?')"
                                                    title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('appointments.attend', $appointment->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-blue-500 hover:underline"
                                                onclick="return confirm('¿Está seguro de que desea marcar este turno como atendido?')"
                                                title="Marcar como Atendido">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                setTimeout(() => toast.remove(), 600);
            }, 3000);
        });
    });
</script>
