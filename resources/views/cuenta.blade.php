@extends('principal')
@section('contenido')
    <div class="headerPerfil">
        <img src="../media/fotoPerfil.webp" class="fotoPerfilCuenta" alt="">
        <div>
            <h2 class="textoCentrado">{{ $cuenta->nombre }}</h2>
            @if(session()->has('usuario') && $cuenta->nombre == session('usuario')->nombre)
                <button type="button" class="btn btn-primary">Editar Perfil <img src="../media/editIcon.png" alt=""></button>
            @endif


        </div>

        <p class="descripcionPefil">{{ $cuenta->descripcion }}</p>

        @if(session()->has('usuario') && $cuenta->nombre == session('usuario')->nombre)
            
            <form action="{{ route('publicarPost') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="texto" class="form-label">Escribe un nuevo post:</label>
                    <textarea class="form-control" id="texto" name="texto" style="height: 100px" required></textarea><br>
                    <input type="hidden" name="usuario" value="{{ session('usuario')->nombre }}">
                    <input class="btn btn-success" type="submit" value="Publicar">
                </div>
            </form>
        @endif
        @foreach ($postsUsuario as $post)
            <div class="card" style="width: 30rem;">
                <a href="{{ route('cuentaUsuario', ['usuario' => $post->usuario]) }}" class="linkCuenta">
                    <div class="card-header">
                        <img src="../media/fotoPerfil.webp" class="fotoPerfilPost" alt="">
                        {{ $post->usuario }}
                    </div>
                </a>
                @if(session()->has('usuario') && $cuenta->nombre == session('usuario')->nombre)
                    <form method="POST" action="{{route('borrarPostEnCuenta', $post->id)}}" style="display:inline;">
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
    </div>
@endsection