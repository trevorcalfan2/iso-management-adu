@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Usuarios</h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Crear Usuario</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Administrador</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_admin ? 'Sí' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
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
@endsection
