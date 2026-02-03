<?php

return [

    // ⚠️ CORS uniquement pour l’API
    'paths' => ['api/*','sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // ✅ SEULEMENT le front qui consomme l’API
    'allowed_origins' => [
       'https://red-product-cn78.vercel.app',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // ❌ false si tu n’utilises PAS Sanctum avec cookies
    'supports_credentials' => true,
];
