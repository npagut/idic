<!-- resources/views/formulario.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form method="post" action="{{ route('formulario.enviarFormulario') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        @if (isset($clientes))
            <h1 class="mt-4">Listado de Clientes</h1>

            <ul class="list-group">
                @foreach ($clientes as $cliente)
                    <li class="list-group-item">{{ $cliente['nombre'] }} - {{ $cliente['email'] }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
