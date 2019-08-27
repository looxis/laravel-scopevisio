<?php

namespace Looxis\Laravel\ScopeVisio;

use GuzzleHttp\Client;
use Looxis\Laravel\ScopeVisio\Exceptions\ConfigurationException;

class ScopeVisio
{
    const ENV_SCOPEVISIO_CUSTOMER = 'SCOPEVISIO_CUSTOMER';
    const ENV_SCOPEVISIO_USERNAME = 'SCOPEVISIO_USERNAME';
    const ENV_SCOPEVISIO_PASSWORD = 'SCOPEVISIO_PASSWORD';

    /**
     * @var string
     */
    protected $customer;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var Client
     */
    public $httpClient;

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
    public function __construct(string $customer = null, string $username = null, string $password = null)
    {
        if ($customer) {
            $this->customer = $customer;
        } else {
            $this->customer = config('scopevisio.customer');
        }

        if ($username) {
            $this->username = $username;
        } else {
            $this->username = config('scopevisio.username');
        }

        if ($password) {
            $this->password = $password;
        }else {
            $this->password = config('scopevisio.password');
        }

        if (!$this->customer || !$this->username || !$this->password) {
            throw new ConfigurationException('Credentials are required');
        }

        $this->token = $this->getToken();

        $this->httpClient = new Client(['headers' => [
            'authorization' => $this->token,
        ]]);
    }


    /**
     * @return string
     */
    private function getToken(): string
    {
        $url = 'https://appload.scopevisio.com/rest/token';
        $client = new Client(['header' => []]);
        $response = $client->post($url, [
            'form_params' => [
                'grant_type' => 'password',
                'customer' => $this->customer,
                'username' => $this->username,
                'password' => $this->password
            ]
        ]);
        $response = json_decode($response->getBody()->getContents());
        return $response->token_type . ' ' . $response->access_token;
    }
}
