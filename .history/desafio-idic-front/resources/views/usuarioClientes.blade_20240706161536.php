@extends('layouts.app') <!-- Asumiendo que tienes un layout principal donde incluyes Bootstrap -->

@section('content')
<div class="container mt-5">
    <h1>Listado de Clientes (Usuario)</h1>

    <ul class="list-group mt-3">
        @foreach ($clientes as $cliente)
            <li class="list-group-item">{{ $cliente['nombre'] }} - {{ $cliente['email'] }}</li>
        @endforeach
    </ul>
</div>
@endsection
