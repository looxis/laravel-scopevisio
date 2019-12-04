<?php


use Looxis\Laravel\ScopeVisio\ScopeVisio;

return [
    'sandbox' => boolval(env(ScopeVisio::ENV_SCOPEVISIO_SANDBOX, env('APP_ENV') !== 'production')),
    'base_uri' => env(ScopeVisio::ENV_SCOPEVISIO_BASE_URI, 'https://appload.scopevisio.com/rest/'),
    'credentials' => [
        'production' => [
            'customer' => env(ScopeVisio::ENV_SCOPEVISIO_CUSTOMER),
            'username' => env(ScopeVisio::ENV_SCOPEVISIO_USERNAME),
            'password' => env(ScopeVisio::ENV_SCOPEVISIO_PASSWORD),
            'organisation' => env(ScopeVisio::ENV_SCOPEVISIO_ORGANISATION),
        ],
        'sandbox' => [
            'customer' => env(ScopeVisio::ENV_SCOPEVISIO_CUSTOMER),
            'username' => env(ScopeVisio::ENV_SCOPEVISIO_USERNAME),
            'password' => env(ScopeVisio::ENV_SCOPEVISIO_PASSWORD),
            'organisation' => env(ScopeVisio::ENV_SCOPEVISIO_SANDBOX_ORGANISATION),
        ],
    ],
];
