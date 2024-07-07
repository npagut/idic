<!-- resources/views/formulario.blade.php -->

<form method="post" action="{{ route('formulario-enviar') }}">
    @csrf

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Enviar</button>
</form>
