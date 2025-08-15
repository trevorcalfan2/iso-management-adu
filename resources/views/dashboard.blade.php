@extends('layouts.app')

@section('content')
    <h1>Bienvenido, {{ Auth::user()->name }}</h1>
    <p>Has iniciado sesión correctamente.</p>
@endsection
