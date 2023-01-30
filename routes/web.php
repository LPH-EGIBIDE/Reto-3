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

Route::get('/', function () {
    //return current user
    return view('dashboard');
})->middleware('auth');

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'can:facilitador_centro'])->group(function () {
    Route::get('/facilitador-centro', function () {
        return "Protected routes for facilitador_centro";
    });
});

Route::middleware(['auth', 'can:facilitador_empresa'])->group(function () {
    Route::get('/facilitador-empresa', function () {
        return "Protected routes for facilitador_empresa";
    });
});

Route::middleware(['auth', 'can:alumno'])->group(function () {
    Route::get('/alumno', function () {
        return "Protected routes for alumno";
    });
});

Route::middleware(['auth', 'can:facilitador'])->group(function () {
    Route::get('/mensajes', [App\Http\Controllers\MensajeController::class, 'index'])->name('mensaje.index');
    Route::post('/mensaje/{id}', [App\Http\Controllers\MensajeController::class, 'store'])->name('mensaje.store')->whereNumber('id');
    Route::get('/mensajes/{id}', [App\Http\Controllers\MensajeController::class, 'chat'])->name('mensaje.chat')->whereNumber('id');
    Route::get('/mensajes/{id}/{page}', [App\Http\Controllers\MensajeController::class, 'chat'])->name('mensaje.chat')->whereNumber('id')->whereNumber('page');
    Route::get('/mensajes/chats', [App\Http\Controllers\MensajeController::class, 'chatters'])->name('mensaje.chatlist');
});


