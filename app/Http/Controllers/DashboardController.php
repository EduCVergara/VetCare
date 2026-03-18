<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Paciente;
use App\Models\Cita;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'totalClientes'    => Cliente::count(),
            'totalPacientes'   => Paciente::count(),
            'citasHoy'         => Cita::whereDate('fecha_hora', today())->count(),
            'ingresosMes'      => 0, // se conectará cuando esté Facturación
            'citasProximas'    => Cita::with(['cliente', 'paciente'])
                                    ->where('fecha_hora', '>=', now())
                                    ->whereNotIn('estado', ['Completada', 'Cancelada'])
                                    ->orderBy('fecha_hora')
                                    ->limit(5)
                                    ->get(),
            'actividadReciente' => $this->actividadReciente(),
        ]);
    }

    private function actividadReciente(): array
    {
        $actividad = collect();

        Cita::with(['cliente', 'paciente'])->latest()->limit(3)->get()
            ->each(fn($c) => $actividad->push([
                'titulo'    => 'Nueva cita registrada',
                'subtitulo' => $c->paciente->nombre . ' — ' . $c->cliente->nombre,
                'tiempo'    => $c->created_at->diffForHumans(),
                'color'     => '#7F77DD',
            ]));

        Cliente::latest()->limit(2)->get()
            ->each(fn($c) => $actividad->push([
                'titulo'    => 'Cliente registrado',
                'subtitulo' => $c->nombre,
                'tiempo'    => $c->created_at->diffForHumans(),
                'color'     => '#378ADD',
            ]));

        return $actividad->sortByDesc('tiempo')->values()->take(5)->toArray();
    }
}