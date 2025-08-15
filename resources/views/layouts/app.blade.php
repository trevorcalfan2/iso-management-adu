<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'ISO Management') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @auth
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboard') }}">ISO Management</a>
                <div class="d-flex">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        </nav>
    @endauth

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
