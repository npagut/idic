<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes (Admin)</title>
    <!-- Agregar Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Listado de Clientes (Admin)</h1>

    <ul class="list-group mt-3">
        @foreach ($clientes as $cliente)
            <li class="list-group-item">{{ $cliente['nombre'] }} - {{ $cliente['email'] }}
                <button class="btn btn-danger btn-sm float-right">Eliminar</button>
                <button class="btn btn-warning btn-sm float-right mr-2">Editar</button>
            </li>
        @endforeach
    </ul>

    <button class="btn btn-primary mt-3">Agregar Cliente</button>
</div>

<!-- Agregar scripts de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
