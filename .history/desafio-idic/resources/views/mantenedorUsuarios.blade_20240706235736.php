@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Listado de Usuarios</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nro. Usuario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Rut</th>
                <th scope="col">Rol</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user['id'] }}</th>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['rut'] }}</td>
                <td>{{ $user['rol'] }}</td>
                <td>
                    <form action="{{ route('user.update', ['user' => $user['id']]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <select name="rol" class="form-control">
                                <option value="admin" {{ $user['rol'] == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="usuario" {{ $user['rol'] == 'usuario' ? 'selected' : '' }}>Usuario</option>
                                <option value="supervisor" {{ $user['rol'] == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
