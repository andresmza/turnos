@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="flex justify-between mb-4">
                <h1 class="text-xl font-bold">Lista de Doctores</h1>
                <a href="{{ route('doctores.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Agregar Doctor
                </a>
            </div>

            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Nombre</th>
                        <th class="py-3 px-6 text-left">Especialidad</th>
                        <th class="py-3 px-6 text-center">Matrícula</th>
                        <th class="py-3 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($doctores as $doctor)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            {{ $doctor->persona->nombre }} {{ $doctor->persona->apellido }}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ $doctor->especialidad->nombre }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            {{ $doctor->matricula }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="{{ route('doctores.show', $doctor) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('doctores.edit', $doctor) }}" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('doctores.destroy', $doctor) }}" method="POST">
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