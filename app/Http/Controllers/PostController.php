<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Manejo de formularios
use App\Services\PostApiService; // Importamos el servicio
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
        // Llamamos al servicio para obtener datos
        $posts = $this->api->obtenerTodos();
        // Enviamos datos a la vista inicio.blade.php
        return view('index', compact('posts'));
    }
}
