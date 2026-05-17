<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Líneas de validación en español
    |--------------------------------------------------------------------------
    |
    | Las siguientes líneas contienen los mensajes de error predeterminados usados por
    | la clase validadora de Laravel. Algunas reglas tienen múltiples versiones como
    | las reglas de tamaño. Puedes modificarlas libremente para personalizar.
    |
    */

    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'alpha'                => 'El campo :attribute solo puede contener letras.',
    'alpha_dash'           => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => 'El campo :attribute solo puede contener letras y números.',
    'array'                => 'El campo :attribute debe ser un arreglo.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a :date.',
    'between'              => [
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe tener entre :min y :max caracteres.',
        'array'   => 'El campo :attribute debe tener entre :min y :max elementos.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'date'                 => 'El campo :attribute no es una fecha válida.',
    'email'                => 'El campo :attribute debe ser una dirección de correo válida.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'gt' => [
        'numeric' => 'El campo :attribute debe ser mayor que :value.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',
    ],
    'gte' => [
        'numeric' => 'El campo :attribute debe ser mayor o igual que :value.',
        'string' => 'El campo :attribute debe tener como mínimo :value caracteres.',
    ],
    'in'                   => 'El campo seleccionado :attribute no es válido.',
    'integer'              => 'El campo :attribute debe ser un número entero.',
    'max'                  => [
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'string'  => 'El campo :attribute no puede tener más de :max caracteres.',
    ],
    'min'                  => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'string'  => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'not_in'               => 'El campo seleccionado :attribute no es válido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'same'                 => 'El campo :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'string'  => 'El campo :attribute debe tener :size caracteres.',
    ],
    'string'               => 'El campo :attribute debe ser texto.',
    'unique'               => 'Este :attribute ya ha sido registrado.',
    'url'                  => 'El formato de :attribute no es válido.',
    'password'             => 'La contraseña es incorrecta.',

    'regex' => 'El formato de :attribute es inválido.',

    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'unidad_o_seccion' => 'unidad o sección',
        'rut' => 'RUT'
    ],
];
