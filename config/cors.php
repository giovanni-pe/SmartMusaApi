<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */
    'paths' => ['api/*'], // Allow CORS for API routes

    'allowed_methods' => ['*'], // Allow all methods (GET, POST, PUT, DELETE, etc.)

    'allowed_origins' => ['http://localhost:4200','http://127.0.0.1:5500'], // Allow requests from Angular app

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Allow all headers, including Authorization

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
