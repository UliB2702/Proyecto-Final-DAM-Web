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