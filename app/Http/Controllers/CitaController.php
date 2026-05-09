<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['cliente', 'paciente'])
            ->orderBy('fecha_hora')
            ->get();

        $citasPorDia = $citas->groupBy(fn($c) => $c->fecha_hora->format('Y-m-d'))
            ->map(fn($grupo) => $grupo->map(fn($c) => [
                'id'       => $c->id,
                'hora'     => $c->fecha_hora->format('H:i'),
                'paciente' => $c->paciente->nombre,
                'cliente'  => $c->cliente->nombre,
                'estado'   => $c->estado,
                'motivo'   => $c->motivo,
            ])->values());

        return view('citas.index', compact('citasPorDia'));
    }

    public function create()
    {
        $clientes  = Cliente::orderBy('nombre')->get();
        $pacientes = Paciente::with('cliente')->orderBy('nombre')->get();
        return view('citas.create', compact('clientes', 'pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'  => 'required|exists:clientes,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_hora'  => 'required|date|after:now',
            'estado'      => 'required|in:Pendiente,Confirmada,En consulta,Completada,Cancelada',
            'motivo'      => 'nullable|string',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')
            ->with('success', 'Cita agendada correctamente.');
    }

    public function edit(Cita $cita)
    {
        $clientes  = Cliente::orderBy('nombre')->get();
        $pacientes = Paciente::with('cliente')->orderBy('nombre')->get();
        return view('citas.edit', compact('cita', 'clientes', 'pacientes'));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'cliente_id'  => 'required|exists:clientes,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_hora'  => 'required|date',
            'estado'      => 'required|in:Pendiente,Confirmada,En consulta,Completada,Cancelada',
            'motivo'      => 'nullable|string',
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.index')
            ->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')
            ->with('success', 'Cita eliminada correctamente.');
    }
}