<?php

return [
    'public_key' => env('EPAYCO_PUBLIC_KEY'),
    'private_key' => env('EPAYCO_PRIVATE_KEY'),
    'test' => env('EPAYCO_TEST', false), // cambiar a false en producción
];
