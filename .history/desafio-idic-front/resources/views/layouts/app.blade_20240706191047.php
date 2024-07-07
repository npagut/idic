<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu aplicación</title>
    <!-- Enlaces a Bootstrap CSS u otros estilos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Otros estilos -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <header>
        <!-- Aquí podrías agregar una barra de navegación común -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Mi Aplicación</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('formulario.mostrar') }}">Formulario</a>
                    </li>
                    <!-- Agrega más elementos de menú según tu aplicación -->
                </ul>
            </div>
        </nav>
    </header>

    <main role="main">
        <div class="container">
            @yield('content') <!-- Aquí se incluirá el contenido específico de cada vista -->
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Pie de página común para todas las páginas.</span>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('access_token')) {
        localStorage.removeItem('access_token');
    }
});
</script>
    <!-- Otros scripts -->
</body>
</html>
