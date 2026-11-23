<?php

use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

// List roles
Route::get('/roles', [RolesController::class, 'index'])
    ->middleware('permission:roles.view')
    ->name('roles.index');

// Show role creation form
Route::get('/roles/create', [RolesController::class, 'create'])
    ->middleware('permission:roles.create')
    ->name('roles.create');

// Store new role
Route::post('/roles/store', [RolesController::class, 'store'])
    ->middleware([
        'permission:roles.create',
        'permission:roles.assign_permissions',
    ])
    ->name('roles.store');

// Show role editing form
Route::get('/roles/{id}/edit', [RolesController::class, 'edit'])
    ->middleware('permission:roles.edit')
    ->name('roles.edit');

// Update role
Route::put('/roles/{id}', [RolesController::class, 'update'])
    ->middleware([
        'permission:roles.edit',
        'permission:roles.assign_permissions',
    ])
    ->name('roles.update');

// Delete role
Route::delete('/roles/{id}', [RolesController::class, 'destroy'])
    ->middleware('permission:roles.delete')
    ->name('roles.delete');
