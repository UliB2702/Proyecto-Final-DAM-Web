<?php

namespace App\Services;

use App\Services;
use Illuminate\Support\Facades\Http;

/**
 * Controlls all the request to the users API
 */
class CuentaApiService
{
    private $baseUrl;

    /**
     * Sets the Base URL for the API
     */
    public function __construct()
    {
        $this->baseUrl = 'http://localhost:8080/apirest_placegiver/rest';
    }

    /**
     * Obtains all the data of a user based on it's name
     * @param mixed $nombre Name of the user whose data is needed
     */
    public function obtenerDatosUsuario($nombre)
    {
        $response = Http::get($this->baseUrl . '/usuarios?nombre=' . $nombre);
        return json_decode($response->body());
    }

    /**
     * Confirms if an user exists with a certain name and password
     * @param mixed $nombre Name of the user
     * @param mixed $pass Password of the user
     */
    public function obtenerDatosUsuarioLogin($nombre, $pass){
        $response = Http::get($this->baseUrl . '/usuarios/login?nombre='. $nombre . '&pass=' . $pass);
        return json_decode($response->body());
    }

    /**
     * Creates a new user and returns the response from the API
     * @param mixed $data Object Usuario with the data of the new user
     */
    public function crearCuenta($data)
    {
        $response = Http::post($this->baseUrl . '/usuarios/registro', $data);
        return json_decode($response->body());
    }
}
