<?php

use App\Http\Controllers\CuentaController;
use App\Http\Controllers\PostController;
use App\Services\CuentaApiService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('inicio');
Route::get('/cuenta/{usuario}', [CuentaController::class, 'cuentaUsuario'])->name('cuentaUsuario');
Route::get('/registro', [CuentaController::class, 'crear'] )->name('registro');
Route::post('/registro', [CuentaController::class, 'almacenarCuenta'])->name('almacenarCuenta');
Route::get('/iniciarSesion', [CuentaController::class, 'iniciarSesion'])->name('iniciarSesion');
Route::post('/login', [CuentaController::class, 'login'])->name('loginUsuario');
Route::get('/logout', [CuentaController::class, 'logout'])->name('logout');
Route::delete('/eliminarPost/{id}', [PostController::class, 'eliminar'])->name('borrarPost');
Route::delete('/eliminarPostCuenta/{id}', [PostController::class, 'eliminarEnCuenta'])->name('borrarPostEnCuenta');
Route::post('/publicar',[PostController::class, 'publicarPost'])->name('publicarPost');