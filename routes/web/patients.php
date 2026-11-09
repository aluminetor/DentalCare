<?php

use App\Http\Controllers\PatientsController;
use Illuminate\Support\Facades\Route;

Route::get('/patients', [PatientsController::class, 'index'])
    ->middleware('permission:patients.view')
    ->name('patients.index');

Route::get('/patients/create', [PatientsController::class, 'create'])
    ->middleware('permission:patients.create')
    ->name('patients.create');

Route::post('/patients/store', [PatientsController::class, 'store'])
    ->middleware('permission:patients.create')
    ->name('patients.store');

Route::get('/patients/edit/{id}', [PatientsController::class, 'edit'])
    ->middleware('permission:patients.edit')
    ->name('patients.edit');

Route::put('/patients/update', [PatientsController::class, 'update'])
    ->middleware('permission:patients.edit')
    ->name('patients.update');

Route::delete('/patients/delete/{id}', [PatientsController::class, 'delete'])
    ->middleware('permission:patients.delete')
    ->name('patients.delete');
