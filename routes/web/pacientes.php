<?php

use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

Route::get('/pacientes', [PacientesController::class, 'index'])->name('pacientes.index');
Route::get('/pacientes/create', [PacientesController::class, 'create'])->name('pacientes.create');
Route::get('/pacientes/edit/{id}', [PacientesController::class, 'edit'])->name('pacientes.edit');

Route::post('/pacientes/store', [PacientesController::class, 'store'])->name('pacientes.store');
Route::put('/pacientes/update', [PacientesController::class, 'update'])->name('pacientes.update');
Route::delete('/pacientes/delete/{id}', [PacientesController::class, 'delete'])->name('pacientes.delete');
