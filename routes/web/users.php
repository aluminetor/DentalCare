<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UsersController::class, 'index'])
    ->middleware('permission:users.view')
    ->name('users.index');

Route::get('/users/create', [UsersController::class, 'create'])
    ->middleware('permission:users.create')
    ->name('users.create');

Route::post('/users/store', [UsersController::class, 'store'])
    ->middleware('permission:users.create')
    ->name('users.store');

Route::get('/users/{id}/edit', [UsersController::class, 'edit'])
    ->middleware('permission:users.edit')
    ->name('users.edit');

Route::put('/users/{id}', [UsersController::class, 'update'])
    ->middleware('permission:users.edit')
    ->name('users.update');

Route::delete('/users/{id}', [UsersController::class, 'destroy'])
    ->middleware('permission:users.delete')
    ->name('users.delete');
