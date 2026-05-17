<?php

return [
    'features' => [
        'email_verification' => env('VETCARE_EMAIL_VERIFICATION', true),
        'two_factor_auth' => env('VETCARE_TWO_FACTOR_AUTH', false),
        'force_password_change' => env('VETCARE_FORCE_PASSWORD_CHANGE', true),
    ],

    'two_factor' => [
        'code_expires_minutes' => env('VETCARE_TWO_FACTOR_EXPIRES_MINUTES', 10),
    ],
];
