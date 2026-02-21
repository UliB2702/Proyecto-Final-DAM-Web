<?php

namespace App\Services;

use App\Services;
use Illuminate\Support\Facades\Http;

class PostApiService
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'http://192.130.0.19:8080/apirest_placegiver/rest';
    }

    public function obtenerTodos()
    {
        // Realiza petición GET
        $response = Http::get($this->baseUrl . '/posts');
        // body() devuelve el JSON como texto
        // json_decode convierte JSON → objetos PHP
        return json_decode($response->body());
    }

    public function obtenerPostDeUsuario($nombre){
        $response = Http::get($this->baseUrl . '/posts/usuario?nombre='.$nombre);
        return json_decode($response->body());
    }
}
