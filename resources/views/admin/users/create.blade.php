@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin">
            <label class="form-check-label" for="is_admin">¿Es Administrador?</label>
        </div>
        <button type="submit" class="btn btn-success mt-3">Crear Usuario</button>
    </form>
</div>
@endsection
