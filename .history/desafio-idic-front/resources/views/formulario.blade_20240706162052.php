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
      <td>@{{ $cliente['telefono'] }}</td>
      <td>@{{ $cliente['email'] }}</td>
      <td>@{{ $cliente['direccion'] }}</td>

    </tr>
    @endforeach

  </tbody>
</table>
            <!-- <h1 class="mt-4">Listado de Clientes</h1>

            <ul class="list-group">
                @foreach ($clientes as $cliente)
                    <li class="list-group-item">{{ $cliente['nombre'] }} - {{ $cliente['email'] }}</li>
                @endforeach
            </ul> -->
        @endif
    </div>
@endsection
