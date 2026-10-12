<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\User;

class HomeController extends Controller
{
    public function index() {

        $totalPacientes = Paciente::count();
        $totalOdontologos = User::whereHas('rol', fn($q) => $q->where('nombre', 'Odontólogo'))->count();
        $totalCitasAtendidas = Cita::where('estado', 'Atendida')->count();

        return view('home/index', compact('totalPacientes', 'totalOdontologos', 'totalCitasAtendidas'));
    }
}
