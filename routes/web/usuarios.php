<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/usuarios', [UsuariosController::class, 'index'])
    ->middleware('permission:usuarios.ver')
    ->name('usuarios.index');

Route::get('/usuarios/create', [UsuariosController::class, 'create'])
    ->middleware('permission:usuarios.crear')
    ->name('usuarios.create');

Route::post('/usuarios/store', [UsuariosController::class, 'store'])
    ->middleware('permission:usuarios.crear')
    ->name('usuarios.store');

Route::get('/usuarios/{usuario}/edit', [UsuariosController::class, 'edit'])
    ->middleware('permission:usuarios.editar')
    ->name('usuarios.edit');

Route::put('/usuarios/{usuario}', [UsuariosController::class, 'update'])
    ->middleware('permission:usuarios.editar')
    ->name('usuarios.update');

Route::delete('/usuarios/{usuario}', [UsuariosController::class, 'destroy'])
    ->middleware('permission:usuarios.eliminar')
    ->name('usuarios.delete');