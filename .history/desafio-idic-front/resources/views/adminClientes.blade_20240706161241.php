@extends('layouts.app') <!-- Asumiendo que tienes un layout principal donde incluyes Bootstrap -->

@section('content')
<div class="container mt-5">
    <h1>Listado de Clientes (Admin)</h1>

    <ul class="list-group mt-3">
        @foreach ($clientes as $cliente)
            <li class="list-group-item">{{ $cliente['nombre'] }} - {{ $cliente['email'] }}
                <button class="btn btn-danger btn-sm float-right">Eliminar</button>
                <button class="btn btn-warning btn-sm float-right mr-2">Editar</button>
            </li>
        @endforeach
    </ul>

    <button class="btn btn-primary mt-3">Agregar Cliente</button>
</div>

