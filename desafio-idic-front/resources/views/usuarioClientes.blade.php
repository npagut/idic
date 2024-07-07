@extends('layouts.app') <!-- Asumiendo que tienes un layout principal donde incluyes Bootstrap -->

@section('content')
<div class="container mt-5">
    <h1>Listado de Clientes (Usuario)</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nro. Cliente</th>
                <th scope="col">Nombre</th>
                <th scope="col">Rut</th>
                <th scope="col">Telefono</th>
                <th scope="col">Email</th>
                <th scope="col">Direccion</th>
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

            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
