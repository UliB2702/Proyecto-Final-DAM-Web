@extends('principal')
@section('contenido')
    <section class="formularioRegistro">
        <div class="card formularioCard" style="width: 18rem;">
            <form method="post" action="{{ route('almacenarCuenta') }}" >
                @csrf
                <h2 class="tituloFormulario">Crear cuenta</h2>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    <label for="nombre">Nombre</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com"
                        required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Descripción" id="descripcion" name="descripcion"
                        style="height: 100px"></textarea>
                    <label for="descripcion">Descripción</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="nombre@ejemplo.com" required>
                    <label for="password">Contraseña</label>
                </div>
                @if(session("mensaje"))
                    <h4 style="color: red;">{{ session("mensaje") }}</h4>
                @endif
                <input class="btn btn-success" type="submit" value="Registrase">
            </form>
        </div>
    </section>
@endsection