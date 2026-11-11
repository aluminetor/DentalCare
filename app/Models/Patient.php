<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['first_name', 'last_name', 'document', 'phone', 'birth_date'];

    protected function casts(): array
    {
        return ['birth_date' => 'date'];
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}
