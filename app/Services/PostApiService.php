<?php

namespace App\Services;

use App\Services;
use Illuminate\Support\Facades\Http;

/**
 * Controlls all the request to the posts API
 */
class PostApiService
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
     * Obtains all the most recent posts in the database and returns it
     */
    public function obtenerTodos()
    {
        $response = Http::get($this->baseUrl . '/posts');
        return json_decode($response->body());
    }

    /**
     * Obtains all the posts of a certain user in the database and returns it. If it isn't successful, sends a empty array
     * @param mixed $nombre Name of the user owner of the posts
     */
    public function obtenerPostDeUsuario($nombre)
    {
        $response = Http::get($this->baseUrl . '/posts/' . $nombre);
        
        if ($response->successful()) {
            return json_decode($response->body());
        }

        return [];
    }

    /**
     * Deletes a post from the database using it's ID
     * @param mixed $id ID of the post that wants to be deleted
     * @return \Illuminate\Http\Client\Response Response Ok or Error depending of the result of the API
     */
    public function eliminar($id)
    {
        return Http::delete($this->baseUrl . '/posts/' . $id);
    }

    /**
     * Creates a posts based on the data sent as param
     * @param mixed Post object with all the data needed
     */
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
