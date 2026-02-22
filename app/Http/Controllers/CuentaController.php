<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CuentaApiService;
use App\Services\PostApiService;

class CuentaController extends Controller
{
    private $api;
    private $apiPosts;
    public function __construct(CuentaApiService $api, PostApiService $apiPosts)
    {
        $this->api = $api;
        $this->apiPosts = $apiPosts;
    }

    public function cuentaUsuario($nombre)
    {
        // Llamamos al servicio para obtener datos
        $cuenta = $this->api->obtenerDatosUsuario($nombre);
        // Enviamos datos a la vista inicio.blade.php
        $postsUsuario = $this->apiPosts->obtenerPostDeUsuario($nombre);
        return view('cuenta', compact('cuenta', 'postsUsuario'));
    }

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

    public function logout()
{
    session()->forget('usuario');
    return redirect()->route('inicio')->with('success', 'Sesión cerrada correctamente');
}

    public function iniciarSesion()
    {
        return view('iniciarSesion');
    }

    public function crear()
    {
        return view('crearCuenta');
    }

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
