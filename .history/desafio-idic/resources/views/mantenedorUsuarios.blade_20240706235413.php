@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Listado usuarios</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nro. Usuario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Rut</th>
                <th scope="col">Rol</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user['id'] }}</th>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['rut'] }}</td>
                <td>{{ $user['rol'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
