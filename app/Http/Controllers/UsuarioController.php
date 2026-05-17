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
            'must_change_password' => true,
        ]);

        if (config('vetcare.features.email_verification')) {
            $usuario->sendEmailVerificationNotification();
        }

        return redirect()->route('usuarios.index')
            ->with('success', config('vetcare.features.email_verification')
                ? 'Usuario creado correctamente. Se envio un correo de verificacion.'
                : 'Usuario creado correctamente.');
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

        if ($emailCambio && config('vetcare.features.email_verification')) {
            $usuario->sendEmailVerificationNotification();
        }

        return redirect()->route('usuarios.index')
            ->with('success', $emailCambio && config('vetcare.features.email_verification')
                ? 'Usuario actualizado correctamente. Se envio un nuevo correo de verificacion.'
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
