<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViveroController;
use App\Http\Controllers\SensoreController;
use App\Http\Controllers\LecturasSensoreController;
use App\Http\Controllers\CultivoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RoleController;

// Rutas resource para cada una de las tablas
Route::resource('viveros', ViveroController::class);
Route::resource('sensores', SensoreController::class);
Route::resource('lecturas-sensores', LecturasSensoreController::class);
Route::resource('cultivos', CultivoController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('roles', RoleController::class);


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
