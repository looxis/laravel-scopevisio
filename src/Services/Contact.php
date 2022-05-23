<?php

namespace Looxis\Laravel\ScopeVisio\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class Contact
{
    /**
     * @param array $formParams
     * @return string
     * @throws GuzzleException
     */
    public function new(array $formParams): array
    {
        $response = \ScopeVisio::client()
            ->post('contact/new', [
                RequestOptions::JSON => $formParams
            ]);

        return json_decode($response->getBody(), true);
    }

    public function show($id): array
    {
        $response = \ScopeVisio::client()->get("contact/$id");
        return  json_decode($response->getBody(), true);
    }

    public function childOrganisations($id): array
    {
        $response = \ScopeVisio::client()->get("contact/$id/childOrganisations");
        return  json_decode($response->getBody(), true);
    }

    public function employees($id): array
    {
        $response = \ScopeVisio::client()->get("contact/$id/employees");
        return  json_decode($response->getBody(), true);
    }

    public function showByIdentifier($identifier = 'id', $id): array
    {
        $response = \ScopeVisio::client()->get("contact/{$identifier}/$id");
        return  json_decode($response->getBody(), true);
    }

    public function search($search = [], array $options = []): array
    {
        $response = \ScopeVisio::client($options)
            ->post('contacts', [
                RequestOptions::JSON => [
                    'search' => $search
                ],
            ]);
        return  json_decode($response->getBody(), true);
    }

}
