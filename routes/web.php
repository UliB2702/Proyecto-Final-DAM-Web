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

/**
 * Main Page
 * Shows the most recent posts
 */
Route::get('/', [PostController::class, 'index'])->name('inicio');

/**
 * Account Page
 * Shows certain user's page sent in the route
 */
Route::get('/cuenta/{usuario}', [CuentaController::class, 'cuentaUsuario'])->name('cuentaUsuario');

/**
 * Register Page
 * The user can create their account here
 */
Route::get('/registro', [CuentaController::class, 'crear'] )->name('registro');

/**
 * Processes user's data to create their account
 */
Route::post('/registro', [CuentaController::class, 'almacenarCuenta'])->name('almacenarCuenta');

/**
 * Log in Page
 * The user can log in with their account here
 */
Route::get('/iniciarSesion', [CuentaController::class, 'iniciarSesion'])->name('iniciarSesion');

/**
 * Processes the user's data to see if they can log in
 */
Route::post('/login', [CuentaController::class, 'login'])->name('loginUsuario');

/**
 * Closes the current session of the user
 */
Route::get('/logout', [CuentaController::class, 'logout'])->name('logout');

/**
 * Deletes a certain post from the Main Page
 */
Route::delete('/eliminarPost/{id}', [PostController::class, 'eliminar'])->name('borrarPost');

/**
 * Deletes a certain post from a User's Page
 */
Route::delete('/eliminarPostCuenta/{id}', [PostController::class, 'eliminarEnCuenta'])->name('borrarPostEnCuenta');

/**
 * Processes the creation of a new Post
 */
Route::post('/publicar',[PostController::class, 'publicarPost'])->name('publicarPost');