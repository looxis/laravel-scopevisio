<?php

namespace Looxis\Laravel\ScopeVisio;

use GuzzleHttp\Client;
use Looxis\Laravel\ScopeVisio\Services\OutgoingInvoice;

class ScopeVisio
{
    const ENV_SCOPEVISIO_SANDBOX = 'SCOPEVISIO_SANDBOX';

    const ENV_SCOPEVISIO_BASE_URI = 'SCOPEVISIO_BASE_URI';
    const ENV_SCOPEVISIO_CUSTOMER = 'SCOPEVISIO_CUSTOMER';
    const ENV_SCOPEVISIO_USERNAME = 'SCOPEVISIO_USERNAME';
    const ENV_SCOPEVISIO_PASSWORD = 'SCOPEVISIO_PASSWORD';
    const ENV_SCOPEVISIO_ORGANISATION = 'SCOPEVISIO_ORGANISATION';

    const ENV_SCOPEVISIO_SANDBOX_ORGANISATION = 'SCOPEVISIO_SANDBOX_ORGANISATION';


    /**
     * @var Client
     */
    public $client;

    /**
     * @var string
     */
    private $token;

    public function outgoingInvoice()
    {
        return resolve(OutgoingInvoice::class);
    }

    public function client($options = [])
    {
        $options = array_replace_recursive(
            [
                'headers' => [
                    'authorization' => $this->getToken(),
                    'accept' => 'application/json',
                    'content-type' => 'application/json'
                ],
                'base_uri' => $this->getConfig('base_uri')
            ],
            $options
        );
        $client = new Client($options);
        return $client;
    }

    public function getConfig($path = null, $default = null)
    {
        $path = 'scopevisio' . ($path ? ".{$path}" : '');
        return config($path, $default);
    }

    public function getCredentials($path = null, $default = null)
    {
        $environment = $this->getConfig('sandbox') ? 'sandbox' : 'production';
        $path = 'credentials.' . $environment . ($path ? ".{$path}" : '');
        return $this->getConfig($path, $default);
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        if ($this->token) {
            return $this->token;
        }

        $client = new Client([
            'base_uri' => $this->getConfig('base_uri')
        ]);

        if ($this->getConfig('sandbox') && !$this->getCredentials('organisation')) {
            throw new \Exception('You need to set the sandbox organisation name!');
        }

        $response = $client->post('token', [
            'form_params' => [
                'grant_type' => 'password',
                'customer' => $this->getCredentials('customer'),
                'username' => $this->getCredentials('username'),
                'password' => $this->getCredentials('password'),
                'organisation' => $this->getCredentials('organisation'),
            ]
        ]);

        $response = json_decode($response->getBody()->getContents());
        $this->token = $response->token_type . ' ' . $response->access_token;
        return $this->token;
    }
}
