@extends('principal')
@section('contenido')
    <div class="headerPerfil">
        <img src="../media/fotoPerfil.webp" class="fotoPerfilCuenta" alt="">
        <div>
            <h2 class="textoCentrado">{{ $cuenta->nombre }}</h2>

            <button type="button" class="btn btn-primary">Hola</button>

        </div>

        <p id="descripcion">{{ $cuenta->descripcion }}</p>
        @foreach ($postsUsuario as $post)
            <div class="card" style="width: 30rem;">
                <a href="{{ route('cuentaUsuario', ['usuario' => $post->usuario]) }}" class="linkCuenta">
                    <div class="card-header">
                        <img src="../media/fotoPerfil.webp" class="fotoPerfilPost" alt="">
                        {{ $post->usuario }}
                    </div>
                </a>
                <div class="card-body">
                    <p class="card-text">{{ $post->texto }}</p>
                </div>
                <img src="../media/image_default.jpg" class="card-img-top" alt="...">
            </div>
        @endforeach
    </div>
@endsection
