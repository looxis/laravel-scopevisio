<?php

namespace Looxis\Laravel\ScopeVisio\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OutgoingInvoice
{
    /**
     * @param array $formParams
     * @return string
     * @throws GuzzleException
     */
    public function import(array $formParams, array $options = []): array
    {
        $response = \ScopeVisio::client($options)
            ->post('outgoinginvoices/import', [
                RequestOptions::JSON => $formParams
            ]);

        return json_decode($response->getBody(), true);
    }

    public function show($number, array $options = []): array
    {
        $response = \ScopeVisio::client($options)->get("outgoinginvoice/$number");
        return  json_decode($response->getBody(), true);
    }

    public function search($search = [], array $options = []): array
    {
        $response = \ScopeVisio::client($options)
            ->post('outgoinginvoices', [
                RequestOptions::JSON => [
                    'search' => $search
                ],
            ]);
        return  json_decode($response->getBody(), true);
    }


    public function getFile($number)
    {
        $options = [
            'headers' => [
                'accept' => 'application/octet-stream',
            ]
        ];
        return \ScopeVisio::client($options)->get("outgoinginvoice/$number/file");
    }


    /** Download pdf file by invoice number
     * @param string $number
     * @return BinaryFileResponse
     * @throws GuzzleException
     */
    public function downloadFile(string $number, $name = null)
    {
        $name = $name ?: $this->buildFileName($number);
        return response()->streamDownload(function () use ($number) {
            echo $this->getFile($number)->getBody();
        }, $name);
    }

    public function buildFileName($number)
    {
        return  'invoice_' . $number . '.pdf';
    }
}
