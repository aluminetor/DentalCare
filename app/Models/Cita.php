<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = ['paciente_id', 'odontologo_id', 'fecha', 'hora', 'motivo', 'estado', 'observaciones'];

    protected function casts(): array
    {
        return ['fecha' => 'date'];
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    // El odontólogo es un usuario (users) con rol Odontólogo
    public function odontologo()
    {
        return $this->belongsTo(User::class, 'odontologo_id');
    }
}
