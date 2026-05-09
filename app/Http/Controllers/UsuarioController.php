<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::latest()->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email',
            'telefono' => 'nullable|string|max:20',
            'cargo'    => 'nullable|string|max:255',
            'rol'      => 'required|in:admin,veterinario,recepcionista,visor',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario = User::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'cargo'    => $request->cargo,
            'rol'      => $request->rol,
            'password' => Hash::make($request->password),
        ]);

        $usuario->sendEmailVerificationNotification();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente. Se envió un correo de verificación.');
    }

    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('usuarios', 'email')->ignore($usuario->id)],
            'telefono' => 'nullable|string|max:20',
            'cargo'    => 'nullable|string|max:255',
            'rol'      => 'required|in:admin,veterinario,recepcionista,visor',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->except('password', 'password_confirmation');
        $emailCambio = $request->email !== $usuario->email;

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($emailCambio) {
            $data['email_verified_at'] = null;
        }

        $usuario->update($data);

        if ($emailCambio) {
            $usuario->sendEmailVerificationNotification();
        }

        return redirect()->route('usuarios.index')
            ->with('success', $emailCambio
                ? 'Usuario actualizado correctamente. Se envió un nuevo correo de verificación.'
                : 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No puede eliminar su propia cuenta.');
        }

        $usuario->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
