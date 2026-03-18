<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'nombre', 'especie', 'raza',
        'edad', 'peso', 'microchip', 'ultima_visita',
    ];

    protected $casts = [
        'ultima_visita' => 'date',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}