<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with('cliente')->latest()->get();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('pacientes.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'   => 'required|exists:clientes,id',
            'nombre'       => 'required|string|max:255',
            'especie'      => 'required|in:Perro,Gato,Ave,Otro',
            'raza'         => 'nullable|string|max:255',
            'edad'         => 'nullable|integer|min:0',
            'peso'         => 'nullable|numeric|min:0',
            'microchip'    => 'nullable|string|unique:pacientes,microchip',
            'ultima_visita'=> 'nullable|date',
        ]);

        Paciente::create($request->all());

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente registrado correctamente.');
    }

    public function edit(Paciente $paciente)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('pacientes.edit', compact('paciente', 'clientes'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'cliente_id'   => 'required|exists:clientes,id',
            'nombre'       => 'required|string|max:255',
            'especie'      => 'required|in:Perro,Gato,Ave,Otro',
            'raza'         => 'nullable|string|max:255',
            'edad'         => 'nullable|integer|min:0',
            'peso'         => 'nullable|numeric|min:0',
            'microchip'    => 'nullable|string|unique:pacientes,microchip,' . $paciente->id,
            'ultima_visita'=> 'nullable|date',
        ]);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente eliminado correctamente.');
    }
}