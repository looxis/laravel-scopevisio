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

}
