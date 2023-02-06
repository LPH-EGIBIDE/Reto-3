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
    Route::get('/index', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');
    //Rutas de la doble autenticación
    //Route::get('/2fa', [App\Http\Controllers\TwoFactorController::class, 'setup'])->name('2fa');
    Route::post('/2fa', function (){ return redirect(route('index')); })->name('auth.2fa');
    Route::get('/2fa/enable', [App\Http\Controllers\TwoFactorController::class, 'show'])->name('2fa.enable.step-1');
    Route::post('/2fa/enable', [App\Http\Controllers\TwoFactorController::class, 'setup'])->name('2fa.enable.step-1.post');
    //Route::get('/2fa/enable/step-2', [App\Http\Controllers\TwoFactorController::class, 'setup'])->name('2fa.enable.step-2');
    Route::post('/2fa/enable/step-2', [App\Http\Controllers\TwoFactorController::class, 'enable'])->name('2fa.enable.step-2');
    Route::post('/2fa/disable', [App\Http\Controllers\TwoFactorController::class, 'disable'])->name('2fa');

    Route::get('/profile', [App\Http\Controllers\PersonaController::class, 'showProfile'])->name('profile.show');
    Route::put('/profile', [App\Http\Controllers\PersonaController::class, 'updateProfile'])->name('profile.update');


//Rutas de los facilitadores de centro

    Route::middleware(['can:facilitador_centro'])->group(function () {
        Route::get('/facilitador-centro', function () {
            return "Protected routes for facilitador_centro";
        });
        Route::get('/empresas/{id}', [App\Http\Controllers\EmpresaController::class, 'show'])->name('empresa.show');
        Route::get('/alumnos', [App\Http\Controllers\AlumnoController::class, 'index'])->name('alumno.index');
        Route::get('/alumnos/api/listado', [App\Http\Controllers\AlumnoController::class, 'filterAlumnos'])->name('alumno.api.listado');
        Route::get('/alumnos/{id}', [App\Http\Controllers\AlumnoController::class, 'show'])->name('alumno.show')->where('id', '[0-9]+');

        Route::get('/cuaderno/{user_id}', [App\Http\Controllers\CuadernoPracticasController::class, 'index'])->name('cuaderno.evaluar.index')->whereNumber('user_id');
        Route::put('/cuaderno/{user_id}', [App\Http\Controllers\CuadernoPracticasController::class, 'evaluar'])->name('cuaderno.evaluar')->whereNumber('user_id');
        Route::get('/cuaderno/{user_id}/api/semana', [App\Http\Controllers\CuadernoPracticasController::class, 'show'])->name('cuaderno.evaluar.api.semana')->whereNumber('user_id');
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
        Route::get('/cuaderno', [App\Http\Controllers\CuadernoPracticasController::class, 'index'])->name('cuaderno.index');
        Route::put('/cuaderno', [App\Http\Controllers\CuadernoPracticasController::class, 'update'])->name('cuaderno.update');
        Route::get('/cuaderno/api/semana', [App\Http\Controllers\CuadernoPracticasController::class, 'show'])->name('cuaderno.api.semana');
        //Route::get('/cuaderno/api/semana2/{id}', [App\Http\Controllers\CuadernoPracticasController::class, 'store'])->name('cuaderno.api.semana')->whereNumber('id');
    });


//Rutas de los coordinadores
    Route::middleware(['can:is_coordinador'])->group(function () {


        Route::get('/facilitadores-centro/api/listado', [App\Http\Controllers\FacilitadorCentroController::class, 'listado'])->name('facilitador-centro.api.listado');
        Route::get('/facilitadores-centro/{id}', [App\Http\Controllers\FacilitadorCentroController::class, 'show'])->name('facilitador-centro.show')->whereNumber('id');
        Route::put('/facilitadores-centro/{id}', [App\Http\Controllers\FacilitadorCentroController::class, 'update'])->name('facilitador-centro.update')->whereNumber('id');
        Route::post('/facilitadores-centro', [App\Http\Controllers\FacilitadorCentroController::class, 'store'])->name('facilitador-centro.store');

        Route::get('/facilitadores-empresa/api/listado', [App\Http\Controllers\FacilitadorEmpresaController::class, 'listado'])->name('facilitador-empresa.api.listado');
        Route::get('/facilitadores-empresa/{id}', [App\Http\Controllers\FacilitadorEmpresaController::class, 'show'])->name('facilitador-empresa.show')->whereNumber('id');
        Route::put('/facilitadores-empresa/{id}', [App\Http\Controllers\FacilitadorEmpresaController::class, 'update'])->name('facilitador-empresa.update')->whereNumber('id');
        Route::post('/facilitadores-empresa', [App\Http\Controllers\FacilitadorEmpresaController::class, 'store'])->name('facilitador-empresa.store');


        Route::get('/cursos/api/listado', [App\Http\Controllers\CursoController::class, 'listado'])->name('cursos.api.listado');
        Route::get('/cursos/{id}', [App\Http\Controllers\CursoController::class, 'show'])->name('curso.show')->whereNumber('id');
        Route::delete('/cursos/{id}', [App\Http\Controllers\CursoController::class, 'destroy'])->name('curso.destroy')->whereNumber('id');
        Route::put('/cursos/{id}', [App\Http\Controllers\CursoController::class, 'update'])->name('curso.update')->whereNumber('id');
        Route::post('/cursos', [App\Http\Controllers\CursoController::class, 'store'])->name('curso.store');
        Route::get('/cursos', [App\Http\Controllers\CursoController::class, 'index'])->name('curso.index');

        Route::get('/grados/api/listado', [App\Http\Controllers\GradoController::class, 'listado'])->name('grado.api.listado');
        Route::get('/grados/{id}', [App\Http\Controllers\GradoController::class, 'show'])->name('grado.show')->whereNumber('id');
        Route::put('/grados/{id}', [App\Http\Controllers\GradoController::class, 'update'])->name('grado.update')->whereNumber('id');
        Route::post('/grados', [App\Http\Controllers\GradoController::class, 'store'])->name('grado.store');
        Route::get('/grados', [App\Http\Controllers\GradoController::class, 'index'])->name('grado.index');

        Route::get('/alumnos/create', [App\Http\Controllers\AlumnoController::class, 'create'])->name('alumno.create');
        Route::post('/alumnos', [App\Http\Controllers\AlumnoController::class, 'store'])->name('alumno.store');
        Route::put('/alumnos/{id}', [App\Http\Controllers\AlumnoController::class, 'update'])->name('alumno.update')->whereNumber('id');

        Route::get('/familias/api/listado', [App\Http\Controllers\FamiliaController::class, 'listado'])->name('familia.api.listado');
        Route::get('/familias', [App\Http\Controllers\FamiliaController::class, 'index'])->name('familia.index');
        Route::get('/familias/{id}', [App\Http\Controllers\FamiliaController::class, 'show'])->name('familia.show')->whereNumber('id');
        Route::put('/familias/{id}', [App\Http\Controllers\FamiliaController::class, 'update'])->name('familia.update')->whereNumber('id');
        Route::post('/familias', [App\Http\Controllers\FamiliaController::class, 'store'])->name('familia.store');


        Route::get('/empresas/api/listado', [App\Http\Controllers\EmpresaController::class, 'listado'])->name('empresa.api.listado');
        Route::get('/empresas', [App\Http\Controllers\EmpresaController::class, 'index'])->name('empresa.index');
        Route::get('/empresas/{id}', [App\Http\Controllers\EmpresaController::class, 'show'])->name('empresa.show')->whereNumber('id');
        Route::put('/empresas/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('empresa.update')->whereNumber('id');
        Route::post('/empresas', [App\Http\Controllers\EmpresaController::class, 'store'])->name('empresa.store');
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

    });

});
