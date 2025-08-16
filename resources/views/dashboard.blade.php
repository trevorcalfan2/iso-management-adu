<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2">
            <div class="sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Gestión de Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('roles.index') }}">Gestión de Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('processes.index') }}">Gestión de Procesos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('isos.index') }}">Archivos ISO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tasks.index') }}">Tareas ISO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notifications.index') }}">Alertas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('configuration.index') }}">Configuración</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            <div class="content">
                <div class="dashboard-header">
                    <h2>Bienvenido a la Gestión ISO</h2>
                    <div class="stats">
                        <div class="stat">
                            <h4>Usuarios</h4>
                            <p>{{ $users_count }}</p>
                        </div>
                        <div class="stat">
                            <h4>Roles</h4>
                            <p>{{ $roles_count }}</p>
                        </div>
                        <div class="stat">
                            <h4>Archivos ISO</h4>
                            <p>{{ $isos_count }}</p>
                        </div>
                        <div class="stat">
                            <h4>Tareas Pendientes</h4>
                            <p>{{ $tasks_count }}</p>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Content -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Usuarios Recientes</div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recent_users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Últimos Archivos ISO Subidos</div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre del Archivo</th>
                                            <th>Estado</th>
                                            <th>Fecha de Vencimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recent_isos as $iso)
                                        <tr>
                                            <td>{{ $iso->id }}</td>
                                            <td>{{ $iso->name }}</td>
                                            <td>{{ $iso->status }}</td>
                                            <td>{{ $iso->expiry_date }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
