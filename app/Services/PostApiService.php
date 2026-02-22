<?php

namespace App\Services;

use App\Services;
use Illuminate\Support\Facades\Http;

class PostApiService
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'http://localhost:8080/apirest_placegiver/rest';
    }

    public function obtenerTodos()
    {
        // Realiza petición GET
        $response = Http::get($this->baseUrl . '/posts');
        // body() devuelve el JSON como texto
        // json_decode convierte JSON → objetos PHP
        return json_decode($response->body());
    }

    public function obtenerPostDeUsuario($nombre)
    {
        $response = Http::get($this->baseUrl . '/posts/' . $nombre);
        return json_decode($response->body());
    }

    public function eliminar($id)
    {
        return Http::delete($this->baseUrl . '/posts/' . $id);
    }

    public function crearPost($data)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])
            ->withBody(json_encode($data), 'application/json')
            ->post($this->baseUrl . '/posts/publicar');

        return json_decode($response->body());

    }
}
