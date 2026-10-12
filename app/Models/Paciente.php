<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = ['nombre', 'apellido', 'documento', 'telefono', 'fecha_nacimiento'];

    protected function casts(): array
    {
        return ['fecha_nacimiento' => 'date'];
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'paciente_id');
    }
}
