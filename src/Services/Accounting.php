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
            ->post('createdebitor', [
                RequestOptions::JSON => $formParams
            ]);

        return json_decode($response->getBody(), true);
    }

    public function getDebitors($search = [], $count = false, $page = 0, $pageSize = 100): array
    {
        $response = \ScopeVisio::client()->post("debitoraccounts", [
            RequestOptions::JSON => [
                'count' => $count,
                'page' => $page,
                "pageSize" => $pageSize,
                'search' => $search
            ],
        ]);
        return  json_decode($response->getBody(), true);
    }

    public function getDebitorBankConnections($number): array
    {
        $response = \ScopeVisio::client()->get("debitoraccounts/{$number}/bankConnections");
        return  json_decode($response->getBody(), true);
    }

}
