<?php

use App\Http\Controllers\CitasController;
use Illuminate\Support\Facades\Route;

Route::get('/citas', [CitasController::class, 'index'])
    ->middleware('permission:citas.ver')
    ->name('citas.index');

Route::get('/citas/create', [CitasController::class, 'create'])
    ->middleware('permission:citas.crear')
    ->name('citas.create');

Route::post('/citas/store', [CitasController::class, 'store'])
    ->middleware('permission:citas.crear')
    ->name('citas.store');

Route::get('/citas/edit/{id}', [CitasController::class, 'edit'])
    ->middleware('permission:citas.editar')
    ->name('citas.edit');

Route::put('/citas/update/{id}', [CitasController::class, 'update'])
    ->middleware('permission:citas.editar')
    ->name('citas.update');

Route::delete('/citas/delete/{id}', [CitasController::class, 'destroy'])
    ->middleware('permission:citas.eliminar')
    ->name('citas.delete');