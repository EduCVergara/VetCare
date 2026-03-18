<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'email', 'telefono', 'direccion',
    ];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}