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
                <td>
                <button class="btn btn-danger btn-sm float-right">Eliminar</button>
                <button class="btn btn-warning btn-sm float-right mr-2">Editar</button>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addClientModal">Agregar Cliente</button>

<!-- Modal -->
<div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">Agregar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('clientes.store') }}">
                <div class="modal-body">
                    @csrf
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
</div>
@endsection



