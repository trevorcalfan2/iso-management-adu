<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Sistema')</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@6.0.0-beta3/css/font-awesome.min.css" rel="stylesheet">
    @yield('styles')  <!-- Para agregar estilos adicionales en las vistas específicas -->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 bg-dark">
                <div class="sidebar bg-dark text-white">
                    <div class="d-flex flex-column vh-100">
                        <div class="p-3">
                            <h3>Admin Panel</h3>
                        </div>
                        <div class="nav flex-column p-3">
                            <a class="nav-link text-white" href="{{ url('/') }}">Dashboard</a>
                            <a class="nav-link text-white" href="{{ route('users.index') }}">Usuarios</a>
                            <a class="nav-link text-white" href="{{ route('roles.index') }}">Roles</a>
                            <a class="nav-link text-white" href="{{ route('isos.index') }}">Archivos ISO</a>
                            <a class="nav-link text-white" href="{{ route('processes.index') }}">Procesos</a>
                            <a class="nav-link text-white" href="{{ route('tasks.index') }}">Tareas</a>
                            <a class="nav-link text-white" href="{{ route('logout') }}">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main content -->
            <div class="col-md-10">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ url('/') }}">Mi Sistema</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </nav>
                
                <div class="container py-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')  <!-- Para agregar scripts adicionales en las vistas específicas -->
</body>
</html>
