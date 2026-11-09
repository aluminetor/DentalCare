<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['patient_id', 'dentist_id', 'date', 'time', 'reason', 'status', 'notes'];

    protected function casts(): array
    {
        return ['date' => 'date'];
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    // The dentist is a user (users) with the Dentist role
    public function dentist()
    {
        return $this->belongsTo(User::class, 'dentist_id');
    }
}
