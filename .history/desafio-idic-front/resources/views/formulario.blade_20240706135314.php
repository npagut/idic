<!-- resources/views/formulario.blade.php -->

<form method="post" action="{{ route('formulario.enviarFormulario') }}">
    @csrf

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Enviar</button>
</form>

<h1>Listado de Clientes</h1>

<ul>
    @foreach ($clientes as $cliente)
        <li>{{ $cliente['nombre'] }} - {{ $cliente['email'] }}</li>
    @endforeach
</ul>
