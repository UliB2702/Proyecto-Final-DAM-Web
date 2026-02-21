@extends('principal')
@section('contenido')
    <aside>
        <ol>
            <li><a href="">Desarrollo</a></li>
            <li><a href="">Propuestas de trabajo</a></li>
            <li><a href="">Preguntas generales</a></li>
            <li></li>
        </ol>
    </aside>
    <section>

        @foreach ($posts as $post)
            <div class="card" style="width: 30rem;">
                <a href="{{ route('cuentaUsuario', ['usuario'=>$post->usuario]) }}" class="linkCuenta">
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

    </section>
@endsection
