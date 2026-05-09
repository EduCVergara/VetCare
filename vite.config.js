import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                    'resources/js/app.js',
                    'resources/js/citas.js',
                    'resources/js/clientes.js',
                    'resources/js/pacientes.js',
                    'resources/js/usuarios.js',
                ],
            refresh: true,
        }),
    ],
});
