<?php


use Looxis\Laravel\ScopeVisio\ScopeVisio;

return [
    'sandbox' => env(ScopeVisio::ENV_SCOPEVISIO_SANDBOX, app()->environment('testing')),
    'base_uri' => env(ScopeVisio::ENV_SCOPEVISIO_BASE_URI, 'https://appload.scopevisio.com/rest/'),
    'credentials' => [
        'production' => [
            'customer' => env(ScopeVisio::ENV_SCOPEVISIO_CUSTOMER),
            'username' => env(ScopeVisio::ENV_SCOPEVISIO_USERNAME),
            'password' => env(ScopeVisio::ENV_SCOPEVISIO_PASSWORD),
        ],
        'sandbox' => [
            'customer' => env(ScopeVisio::ENV_SCOPEVISIO_SANDBOX_CUSTOMER),
            'username' => env(ScopeVisio::ENV_SCOPEVISIO_SANDBOX_USERNAME),
            'password' => env(ScopeVisio::ENV_SCOPEVISIO_SANDBOX_PASSWORD),
        ],
    ],
];
