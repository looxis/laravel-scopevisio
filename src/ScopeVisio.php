<?php

namespace Looxis\Laravel\ScopeVisio;

use GuzzleHttp\Client;
use Looxis\Laravel\ScopeVisio\Exceptions\ConfigurationException;
use Looxis\Laravel\ScopeVisio\Services\OutgoingInvoice;

class ScopeVisio
{
    const ENV_SCOPEVISIO_SANDBOX = 'SCOPEVISIO_SANDBOX';

    const ENV_SCOPEVISIO_CUSTOMER = 'SCOPEVISIO_CUSTOMER';
    const ENV_SCOPEVISIO_USERNAME = 'SCOPEVISIO_USERNAME';
    const ENV_SCOPEVISIO_PASSWORD = 'SCOPEVISIO_PASSWORD';

    const ENV_SCOPEVISIO_SANDBOX_CUSTOMER = 'SCOPEVISIO_SANDBOX_CUSTOMER';
    const ENV_SCOPEVISIO_SANDBOX_USERNAME = 'SCOPEVISIO_SANDBOX_USERNAME';
    const ENV_SCOPEVISIO_SANDBOX_PASSWORD = 'SCOPEVISIO_SANDBOX_PASSWORD';
    const ENV_SCOPEVISIO_BASE_URI = 'SCOPEVISIO_BASE_URI';

    /**
     * @var Client
     */
    public $client;

    /**
     * @var string
     */
    private $token;

    /**
     * ScopeVisio constructor.
     * @param string|null $customer
     * @param string|null $username
     * @param string|null $password
     * @throws ConfigurationException
     */
    public function __construct()
    {
        $this->token = $this->getToken();
        $this->client = $this->createClient();
    }

    public function outgoingInvoice()
    {
        return resolve(OutgoingInvoice::class);
    }

    public function createClient($options = [])
    {
        $options = array_replace_recursive(
            [
                'headers' => [
                    'authorization' => $this->token,
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

    public function client()
    {
        return $this->client;
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
        $client = new Client([
            'base_uri' => $this->getConfig('base_uri')
        ]);

        $response = $client->post('token', [
            'form_params' => [
                'grant_type' => 'password',
                'customer' => $this->getCredentials('customer'),
                'username' => $this->getCredentials('username'),
                'password' => $this->getCredentials('password'),
            ]
        ]);

        $response = json_decode($response->getBody()->getContents());
        return $response->token_type . ' ' . $response->access_token;
    }
}
