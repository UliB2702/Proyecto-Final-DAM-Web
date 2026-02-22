@extends('principal')
@section('contenido')
    <section class="formularioRegistro">
        <div class="card formularioCard" style="width: 18rem;">
            <form action="{{ route('loginUsuario') }}" method="POST">
                @csrf
                <h2 class="tituloFormulario">Iniciar Sesión</h2>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    <label for="nombre">Nombre</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="pass" name="pass"
                        placeholder="nombre@ejemplo.com" required>
                    <label for="pass">Contraseña</label>
                </div>
                <input class="btn btn-success" type="submit" value="Iniciar Sesión">
            </form>
        </div>
    </section>
@endsection