@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Listado de Clientes (Admin)</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
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

    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addClientModal">Agregar Cliente</button>

    <!-- Modal de Agregar Cliente -->
    <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Agregar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('formulario.storeCliente') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="rut">Rut</label>
                            <input type="text" class="form-control" id="rut" name="rut" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Direccion</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Edición -->
    @foreach ($clientes as $cliente)
    <div class="modal fade" id="editClientModal{{$cliente['id']}}" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel{{$cliente['id']}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel{{$cliente['id']}}">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateForm_{{ $cliente['id'] }}" action="{{ route('formulario.update', ['id' => $cliente['id']]) }}" method="POST">
    @csrf
    @method('POST')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="direccion{{$cliente['id']}}">Dirección</label>
                            <input type="text" class="form-control" id="direccion{{$cliente['id']}}" name="direccion" value="{{$cliente['direccion']}}" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono{{$cliente['id']}}">Teléfono</label>
                            <input type="text" class="form-control" id="telefono{{$cliente['id']}}" name="telefono" value="{{$cliente['telefono']}}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
