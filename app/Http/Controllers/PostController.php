<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Manejo de formularios
use App\Services\PostApiService; // Importamos el servicio
use App\Services\CuentaApiService;

class PostController extends Controller
{
    // Propiedad con referencia al servicio
    private $api;
    // Inyección de dependencias
    // Laravel crea automáticamente el servicio
    public function __construct(PostApiService $api)
    {
        $this->api = $api;
    }

    public function index()
    {
        if (session()->has('usuario')) {
            $usuario = session('usuario');

            $existe = app(CuentaApiService::class)->obtenerDatosUsuario($usuario->nombre);

            if (!$existe) {
                session()->forget('usuario');
            }
        }
        $posts = $this->api->obtenerTodos();
        return view('index', compact('posts'));
    }

    public function publicarPost(Request $request)
    {
        $resultado = $this->api->crearPost($request->only(['texto', 'usuario']));
        if (isset($resultado->success) && $resultado->success === true) {
            return redirect()->route('cuentaUsuario', ['usuario' => session('usuario')->nombre])
            ->with('mensaje', 'Post creado correctamente');
        } else {
            $error = $resultado->message ?? 'Error al crear la publicacion';
            return redirect()->back()->withInput()->with('error', $error);
        }
    }

    public function eliminar($id)
    {
        $this->api->eliminar($id);
        return redirect()->route('inicio')
            ->with('mensaje', 'Post eliminado correctamente');
    }

    public function eliminarEnCuenta($id)
    {
        $this->api->eliminar($id);
        return redirect()->route('cuentaUsuario', ['usuario' => session('usuario')->nombre])
            ->with('mensaje', 'Post eliminado correctamente');
    }

}
