<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'paciente_id', 'fecha_hora', 'estado', 'motivo',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}