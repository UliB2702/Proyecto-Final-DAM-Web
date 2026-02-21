<?php

namespace App\Services;

use App\Services;
use Illuminate\Support\Facades\Http;


class CuentaApiService
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'http://192.130.0.19:8080/apirest_placegiver/rest';
    }

    public function obtenerDatosUsuario($nombre)
    {
        $response = Http::get($this->baseUrl . '/usuarios?nombre=' . $nombre);
        return json_decode($response->body());
    }

    public function obtenerDatosUsuarioLogin($nombre, $pass){
        $response = Http::get($this->baseUrl . '/usuarios/login?nombre='. $nombre . '&pass=' . $pass);
        return json_decode($response->body());
    }

    public function crearCuenta($data)
    {
        $response = Http::post($this->baseUrl . '/usuarios/registro', $data);
        return json_decode($response->body());
    }
}
