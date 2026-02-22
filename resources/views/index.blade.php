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
    <section class="sectionIndex">
        @foreach ($posts as $post)
            <div class="card" style="width: 30rem;">
                <a href="{{ route('cuentaUsuario', ['usuario' => $post->usuario]) }}" class="linkCuenta">
                    <div class="card-header">
                        <img src="../media/fotoPerfil.webp" class="fotoPerfilPost" alt="">
                        {{ $post->usuario }}
                    </div>
                </a>
                @if(session()->has('usuario') && $post->usuario == session('usuario')->nombre)
                    <form method="POST" action="{{route('borrarPost', $post->id)}}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Borrar post?')">Borrar
                            post</button>
                    </form>
                @endif
                <div class="card-body">
                    <p class="card-text">{{ $post->texto }}</p>
                </div>
                <img src="../media/image_default.jpg" class="card-img-top" alt="...">
            </div>
        @endforeach

    </section>
@endsection