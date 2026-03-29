<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CuentaApiService;
use App\Services\PostApiService;

/**
 * Controller where all pages related to users are handled
 */
class CuentaController extends Controller
{
    private $api;
    private $apiPosts;

    /**
     * Sets the API Services used in this controller
     * @param CuentaApiService $api API Service that controlls all the data related to Users 
     * @param PostApiService $apiPosts API Service that controlls all the data related to Posts 
     */
    public function __construct(CuentaApiService $api, PostApiService $apiPosts)
    {
        $this->api = $api;
        $this->apiPosts = $apiPosts;
    }

    /**
     * Calls both Cuenta and Post API Services for all the data related to a user and
     * sends it to the view 'cuenta' so it can show it there
     * @param mixed $nombre
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cuentaUsuario($nombre)
    {
        $cuenta = $this->api->obtenerDatosUsuario($nombre);
        $postsUsuario = $this->apiPosts->obtenerPostDeUsuario($nombre);
        return view('cuenta', compact('cuenta', 'postsUsuario'));
    }

    /**
     * Verifies if the data received from the 'iniciarSesion' view is correct
     * @param Request $request User's data that wants to be verified
     * @return \Illuminate\Http\RedirectResponse If the data is correct, saves it as a session an redirects to the 'inicio' view. If not, 
     * informs of the error and goes back to 'iniciarSesion'
     */
    public function login(Request $request)
    {
        $nombre = $request->nombre;
        $pass = $request->pass;

        $cuenta = $this->api->obtenerDatosUsuarioLogin($nombre, $pass);

        if ($cuenta) {
            session(['usuario' => $cuenta]);
            return redirect()->route('inicio');
        } else {
            return redirect()->back()->with('error', 'Usuario o contraseña incorrectos');
        }
    }

    /**
     * Deletes the current logged user from session and returns to the 'inicio' route
     * @return \Illuminate\Http\RedirectResponse Reponse if the closed session was successful or not
     */
    public function logout()
{
    session()->forget('usuario');
    return redirect()->route('inicio')->with('success', 'Sesión cerrada correctamente');
}

    /**
     * Opens the 'iniciarSesion' view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View Returns the 'inciarSesion' view
     */
    public function iniciarSesion()
    {
        return view('iniciarSesion');
    }

    /**
     * Opens the 'crearCuenta' view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View Returns the 'crearCuenta' view
     */
    public function crear()
    {
        return view('crearCuenta');
    }

    /**
     * Verifies if an user can be created with the data redirects the user depending of the result
     * @param Request $request Data of the user that wants to be created
     * @return \Illuminate\Http\RedirectResponse If the creation of a user is successful, adds the data as a session 
     * and redirects the page to the 'inicio' route. If it's not, goes back to 'crearCuenta' view with an message
     */
    public function almacenarCuenta(Request $request)
    {
        $resultado = $this->api->crearCuenta($request->only(['nombre', 'descripcion', 'email', 'password']));
        if (isset($resultado->success) && $resultado->success === true) {
            $usuario = $this->api->obtenerDatosUsuarioLogin(
                $request->nombre,
                $request->password
            );
            session(['usuario' => $usuario]);
            return redirect()->route('inicio');
        } else {
            $error = $resultado->message ?? 'Error al crear la cuenta';
            return redirect()->back()->withInput()->with('error', $error);
        }
    }
}
