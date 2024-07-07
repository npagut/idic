@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Listado de Clientes (Admin)</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Rut</th>
                <th scope="col">Rol</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $cliente['id'] }}</th>
                <td>{{ $cliente['nombre'] }}</td>
                <td>{{ $cliente['rut'] }}</td>
                <td>{{ $cliente['rol'] }}</td>
                <td>
                    <form id="deleteForm_{{ $cliente['id'] }}" action="{{ route('formulario.eliminar', ['id' => $cliente['id']]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro que deseas eliminar este cliente?')">Eliminar</button>
                    </form>
                    <a href="#" class="btn btn-warning btn-sm ml-2" data-toggle="modal" data-target="#editClientModal{{$cliente['id']}}">
                        Editar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
