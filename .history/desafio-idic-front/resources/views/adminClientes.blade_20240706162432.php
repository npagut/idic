@extends('layouts.app') <!-- Asumiendo que tienes un layout principal donde incluyes Bootstrap -->

@section('content')
<div class="container mt-5">
    <h1>Listado de Clientes (Admin)</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nro. Cliente</th>
                <th scope="col">Nombre</th>
                <th scope="col">Rut</th>
                <th scope="col">Telefono</th>
                <th scope="col">Email</th>
                <th scope="col">Direccion</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>

                <th scope="row">{{ $cliente['id'] }}</th>
                <td>{{ $cliente['nombre'] }}</td>
                <td>{{ $cliente['rut'] }}</td>
                <td>{{ $cliente['telefono'] }}</td>
                <td>{{ $cliente['email'] }}</td>
                <td>{{ $cliente['direccion'] }}</td>
                <button class="btn btn-danger btn-sm float-right">Eliminar</button>
                <button class="btn btn-warning btn-sm float-right mr-2">Editar</button>
            </tr>
            @endforeach

        </tbody>
    </table>

    <button class="btn btn-primary mt-3">Agregar Cliente</button>
</div>
@endsection

