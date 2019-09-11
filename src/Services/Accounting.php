<?php

namespace Looxis\Laravel\ScopeVisio\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class Accounting
{
    /**
     * @param array $formParams
     * @return string
     * @throws GuzzleException
     */
    public function createDebitor(array $formParams): array
    {
        $response = \ScopeVisio::client()
            ->post('createDebitor', [
                RequestOptions::JSON => $formParams
            ]);

        return json_decode($response->getBody(), true);
    }

}
