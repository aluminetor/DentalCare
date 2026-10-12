<?php

use App\Http\Controllers\CitasController;
use Illuminate\Support\Facades\Route;

Route::get('/citas', [CitasController::class, 'index'])
    ->name('citas.index');

Route::get('/citas/create', [CitasController::class, 'create'])
    ->name('citas.create');

Route::post('/citas/store', [CitasController::class, 'store'])
    ->name('citas.store');

Route::get('/citas/edit/{id}', [CitasController::class, 'edit'])
    ->name('citas.edit');

Route::put('/citas/update/{id}', [CitasController::class, 'update'])
    ->name('citas.update');

Route::delete('/citas/delete/{id}', [CitasController::class, 'destroy'])
    ->name('citas.delete');