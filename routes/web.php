<?php

use App\Models\Persona;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['register' => false]);
//Rutas de todos los usuarios
Route::middleware(['auth'])->group(function() {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');
    Route::get('/cursos/listado', [App\Http\Controllers\CursoController::class, 'listado'])->name('cursos.listado');
    Route::get('/grados/listado', [App\Http\Controllers\GradoController::class, 'listado'])->name('grados.listado');
    Route::get('/familias/listado', [App\Http\Controllers\FamiliaController::class, 'listado'])->name('familias.listado');
    Route::get('/empresas/listado', [App\Http\Controllers\EmpresaController::class, 'listado'])->name('empresas.listado');
});

//Rutas de los facilitadores de centro

Route::middleware(['auth', 'can:facilitador_centro'])->group(function () {
    Route::get('/facilitador-centro', function () {
        return "Protected routes for facilitador_centro";
    });
    Route::get('/alumnos', [App\Http\Controllers\AlumnoController::class, 'filterAlumnos'])->name('alumno.index');
});


//Rutas de los facilitadores de empresa
Route::middleware(['auth', 'can:facilitador_empresa'])->group(function () {
    Route::get('/facilitador-empresa', function () {
        return "Protected routes for facilitador_empresa";
    });
});

//Rutas de los alumnos
Route::middleware(['auth', 'can:alumno'])->group(function () {
    Route::get('/alumno', function () {
        return "Protected routes for alumno";
    });
});


//Rutas de los coordinadores
Route::middleware(['auth', 'can:is_coordinador'])->group(function () {


});

//Rutas de cualquier tipo de facilitador
Route::middleware(['auth', 'can:facilitador'])->group(function () {
    Route::get('/mensajes', [App\Http\Controllers\MensajeController::class, 'index'])->name('mensaje.index');
    Route::post('/mensaje/{id}', [App\Http\Controllers\MensajeController::class, 'store'])->name('mensaje.store')->whereNumber('id');
    Route::get('/mensajes/{id}', [App\Http\Controllers\MensajeController::class, 'chat'])->name('mensaje.chat')->whereNumber('id');
    Route::get('/mensajes/{id}/{page}', [App\Http\Controllers\MensajeController::class, 'chat'])->name('mensaje.chat')->whereNumber('id')->whereNumber('page');
    Route::get('/mensajes/chats', [App\Http\Controllers\MensajeController::class, 'chatters'])->name('mensaje.chatlist');
});


