<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Services\PostApiService;
use App\Services\CuentaApiService;

/**
 * Controller where all pages related to posts are handled
 */
class PostController extends Controller
{
    private $api;

    /**
     * Sets the API Services used in this controller
     * @param PostApiService $api API Service that controlls all the data related to Posts 
     */
    public function __construct(PostApiService $api)
    {
        $this->api = $api;
    }

    /**
     * Verifies is there is a session with an actual user from the database and loads (if it's not valid, deletes the session) 
     * the mosts recents posts for the 'index'
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View 'Index' view with the mosts recent posts
     */
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

    /**
     * Creates a Post in the database and infors if the creation was correct
     * @param Request $request Data of the Post that wants to be created
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Eliminates a post and goes back to the 'inicio' route
     * @param mixed $id Post's ID that wants to be deleted
     * @return \Illuminate\Http\RedirectResponse Goes back to the 'inicio' view informing of the post deleted
     */
    public function eliminar($id)
    {
        $this->api->eliminar($id);
        return redirect()->route('inicio')
            ->with('mensaje', 'Post eliminado correctamente');
    }

    /**
     * Eliminates a post and goes back to the current logged user page
     * @param mixed $id Post's ID that wants to be deleted
     * @return \Illuminate\Http\RedirectResponse Goes back to the 'cuentaUsuario' view informing of the post deleted
     */
    public function eliminarEnCuenta($id)
    {
        $this->api->eliminar($id);
        return redirect()->route('cuentaUsuario', ['usuario' => session('usuario')->nombre])
            ->with('mensaje', 'Post eliminado correctamente');
    }

}
