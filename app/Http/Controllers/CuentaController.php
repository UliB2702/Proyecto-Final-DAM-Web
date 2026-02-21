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

    public function login($nombre, $pass){
        $cuenta = $this->api->obtenerDatosUsuarioLogin($nombre, $pass);
    }

    public function crear(){
        return view('crearCuenta');
    }

    public function almacenarCuenta(Request $request){
        $this->api->crearCuenta($request->only(['nombre','descripcion','email','password']));
        return redirect()->route('inicio');
    }
}
