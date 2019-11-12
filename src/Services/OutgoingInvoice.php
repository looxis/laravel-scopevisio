<?php

namespace Looxis\Laravel\ScopeVisio\Services;

use GuzzleHttp\RequestOptions;
use Looxis\Laravel\ScopeVisio\Services\Partials\OutgoingInvoice\ImportVariables;
use Looxis\Laravel\ScopeVisio\Services\Partials\OutgoingInvoice\ImportXml;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OutgoingInvoice
{
    /**
     * @param ImportVariables $importVariables
     * @param ImportXml $importXml
     * @return array
     */
    public function import(ImportVariables $importVariables, ImportXml $importXml): array
    {
        $formParams = $importVariables->toArray();
        $formParams['data'] = $importXml->toString();
        $response = \ScopeVisio::client()
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


    /**
     * @param $number
     * @return mixed
     */
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
     * @param null $name
     * @return BinaryFileResponse
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
