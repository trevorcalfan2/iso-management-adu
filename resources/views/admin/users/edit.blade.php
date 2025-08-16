@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña (Dejar vacío para no cambiar)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
            <label class="form-check-label" for="is_admin">¿Es Administrador?</label>
        </div>
        <button type="submit" class="btn btn-success mt-3">Actualizar Usuario</button>
    </form>
</div>
@endsection
