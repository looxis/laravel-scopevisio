<?php


use Looxis\Laravel\ScopeVisio\ScopeVisio;

return [
    'customer' => env(ScopeVisio::ENV_SCOPEVISIO_CUSTOMER, ''),
    'username' => env(ScopeVisio::ENV_SCOPEVISION_USERNAME, ''),
    'password' => env(ScopeVisio::ENV_SCOPEVISIO_PASSWORD, ''),

    'pdf_storage_files' => storage_path() . '/app/scopevisio/pdf',
];