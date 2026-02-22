<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placegiver</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>

<body>


    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('inicio') }}">
                <img src="{{ asset('media/logo.png') }}" alt="Bootstrap" width="80" height="54">
            </a>
            <div class="contenedorLinks">
                @if(session()->has('usuario'))
                    <a class="linkSesion" href="{{  route('cuentaUsuario', ['usuario' => session('usuario')->nombre]) }}">
                        <img src="../media/fotoPerfil.webp" class="fotoPerfilPost" alt="">
                        <span>{{ session('usuario')->nombre }}</span>
                    </a>

                    <a class="linkCerrar" href="{{ route('logout') }}">Cerrar sesión</a>
                @else
                    <a class="linkSesion" href="{{ route(name: 'iniciarSesion') }}">Iniciar Sesion</a>
                    <a class="linkSesion" href="{{ route('registro') }}">Registro</a>
                @endif

            </div>

        </div>
    </nav>
    @yield('contenido')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>