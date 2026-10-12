<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Un archivo de rutas por módulo. Cuando crees uno nuevo, inclúyelo aquí.
include('web/pacientes.php');
require __DIR__.'/web/citas.php';
