<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $totalDentists = User::whereHas('role', fn ($q) => $q->where('name', 'Dentist'))->count();
        $totalCompletedAppointments = Appointment::where('status', 'Completed')->count();

        return view('home/index', compact('totalPatients', 'totalDentists', 'totalCompletedAppointments'));
    }
}
