<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nombre'   => 'Administrador',
            'email'    => 'admin@vetcare.cl',
            'telefono' => null,
            'cargo'    => 'Administrador del Sistema',
            'rol'      => 'admin',
            'password' => Hash::make('password'),
        ]);
    }
}