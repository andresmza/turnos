@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Staffs</h1>
    <a href="{{ route('staffs.create') }}" class="btn btn-primary mb-3">Crear Staff</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffs as $staff)
                    <tr>
                        <td>{{ $staff->id }}</td>
                        <td>{{ $staff->person->first_name }} {{ $staff->person->last_name }}</td>
                        <td>
                            <a href="{{ route('staffs.show', $staff->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('staffs.edit', $staff->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('staffs.destroy', $staff->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
