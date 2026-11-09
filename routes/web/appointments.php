<?php

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Route;

Route::get('/appointments', [AppointmentsController::class, 'index'])
    ->middleware('permission:appointments.view')
    ->name('appointments.index');

Route::get('/appointments/create', [AppointmentsController::class, 'create'])
    ->middleware('permission:appointments.create')
    ->name('appointments.create');

Route::post('/appointments/store', [AppointmentsController::class, 'store'])
    ->middleware('permission:appointments.create')
    ->name('appointments.store');

Route::get('/appointments/edit/{id}', [AppointmentsController::class, 'edit'])
    ->middleware('permission:appointments.edit')
    ->name('appointments.edit');

Route::put('/appointments/update/{id}', [AppointmentsController::class, 'update'])
    ->middleware('permission:appointments.edit')
    ->name('appointments.update');

Route::delete('/appointments/delete/{id}', [AppointmentsController::class, 'destroy'])
    ->middleware('permission:appointments.delete')
    ->name('appointments.delete');
