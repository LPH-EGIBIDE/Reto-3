<?php

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
Route::middleware(['auth', '2fa'])->group(function () {

    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');

    //Rutas de la doble autenticación
    //Route::get('/2fa', [App\Http\Controllers\TwoFactorController::class, 'setup'])->name('2fa');
    Route::post('/2fa', function (){ return redirect(route('index')); })->name('auth.2fa');
    Route::get('/2fa/enable', [App\Http\Controllers\TwoFactorController::class, 'show'])->name('2fa.enable.step-1');
    Route::post('/2fa/enable', [App\Http\Controllers\TwoFactorController::class, 'setup'])->name('2fa.enable.step-1.post');
    //Route::get('/2fa/enable/step-2', [App\Http\Controllers\TwoFactorController::class, 'setup'])->name('2fa.enable.step-2');
    Route::post('/2fa/enable/step-2', [App\Http\Controllers\TwoFactorController::class, 'enable'])->name('2fa.enable.step-2');
    Route::post('/2fa/disable', [App\Http\Controllers\TwoFactorController::class, 'disable'])->name('2fa');

    Route::get('/cursos/listado', [App\Http\Controllers\CursoController::class, 'listado'])->name('cursos.listado');
    Route::get('/grados/listado', [App\Http\Controllers\GradoController::class, 'listado'])->name('grados.listado');
    Route::get('/familias/listado', [App\Http\Controllers\FamiliaController::class, 'listado'])->name('familias.listado');
    Route::get('/empresas/listado', [App\Http\Controllers\EmpresaController::class, 'listado'])->name('empresas.listado');


//Rutas de los facilitadores de centro

    Route::middleware(['can:facilitador_centro'])->group(function () {
        Route::get('/facilitador-centro', function () {
            return "Protected routes for facilitador_centro";
        });
        Route::get('/alumnos', [App\Http\Controllers\AlumnoController::class, 'filterAlumnos'])->name('alumno.index');
    });


//Rutas de los facilitadores de empresa
    Route::middleware(['can:facilitador_empresa'])->group(function () {
        Route::get('/facilitador-empresa', function () {
            return "Protected routes for facilitador_empresa";
        });
    });

//Rutas de los alumnos
    Route::middleware(['can:alumno'])->group(function () {
        Route::get('/alumno', function () {
            return "Protected routes for alumno";
        });
        Route::get('/cuaderno', [App\Http\Controllers\CuadernoPracticasController::class, 'show'])->name('cuaderno.show');
    });


//Rutas de los coordinadores
    Route::middleware(['can:is_coordinador'])->group(function () {


    });

//Rutas de cualquier tipo de facilitador
    Route::middleware(['can:facilitador'])->group(function () {
        Route::get('/mensajes', [App\Http\Controllers\MensajeController::class, 'index'])->name('mensaje.index');
        Route::post('/mensaje/{id}', [App\Http\Controllers\MensajeController::class, 'store'])->name('mensaje.store')->whereNumber('id');
        Route::get('/mensajes/{id}', [App\Http\Controllers\MensajeController::class, 'chat'])->name('mensaje.chat')->whereNumber('id');
        Route::get('/mensajes/{id}/{page}', [App\Http\Controllers\MensajeController::class, 'chat'])->name('mensaje.chat')->whereNumber('id')->whereNumber('page');
        Route::get('/mensajes/chats', [App\Http\Controllers\MensajeController::class, 'chatters'])->name('mensaje.chatlist');


        //Rutas de vista de alumnos
        Route::get('/alumnos/{id}', [App\Http\Controllers\AlumnoController::class, 'show'])->name('alumno.show')->whereNumber('id');


        //Rutas de vista de cursos
        Route::get('/cursos/{id}', [App\Http\Controllers\CursoController::class, 'show'])->name('curso.show')->whereNumber('id');


        //Rutas de vista de empresas
        Route::get('/empresas/{id}', [App\Http\Controllers\EmpresaController::class, 'show'])->name('empresa.show')->whereNumber('id');

    });

});
