<?php

return [

    // Les chemins de l'API à protéger par CORS
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Méthodes autorisées
    'allowed_methods' => ['*'],

    // Origines autorisées (frontend)
    'allowed_origins' => [
        'https://red-product-cn78.vercel.app', // ton frontend
        'http://localhost:5174',               // dev local
        'http://127.0.0.1:5174',               // dev local
    ],

    // Autoriser tous les headers
    'allowed_headers' => ['*'],

    // Headers exposés côté frontend
    'exposed_headers' => [],

    // Durée max du cache préflight
    'max_age' => 0,

    // IMPORTANT : true si tu utilises Sanctum avec cookies
    'supports_credentials' => true,
];
