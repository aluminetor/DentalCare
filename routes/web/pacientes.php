<?php

use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

Route::get('/pacientes', [PacientesController::class, 'index'])
    ->middleware('permission:pacientes.ver')
    ->name('pacientes.index');

Route::get('/pacientes/create', [PacientesController::class, 'create'])
    ->middleware('permission:pacientes.registrar')
    ->name('pacientes.create');

Route::post('/pacientes/store', [PacientesController::class, 'store'])
    ->middleware('permission:pacientes.registrar')
    ->name('pacientes.store');

Route::get('/pacientes/edit/{id}', [PacientesController::class, 'edit'])
    ->middleware('permission:pacientes.editar')
    ->name('pacientes.edit');

Route::put('/pacientes/update', [PacientesController::class, 'update'])
    ->middleware('permission:pacientes.editar')
    ->name('pacientes.update');

Route::delete('/pacientes/delete/{id}', [PacientesController::class, 'delete'])
    ->middleware('permission:pacientes.eliminar')
    ->name('pacientes.delete');