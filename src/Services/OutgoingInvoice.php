<?php

namespace Looxis\Laravel\ScopeVisio\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use SoapClient;
use SoapFault;
use SoapVar;
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

    public function postInvoice($id, array $options = []): array
    {
        $response = \ScopeVisio::client($options)
            ->post("outgoinginvoice/{$id}/post", []);

        return json_decode($response->getBody(), true);
    }

    /**
     * @param array $formParams
     * @return string
     * @throws GuzzleException
     */
    public function new(array $formParams, array $options = []): array
    {
        $response = \ScopeVisio::client($options)
            ->post('outgoinginvoice/new', [
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

    /**
     * @param array $invoices
     * @return mixed
     * @throws SoapFault
     */
    public function doPost(array $invoices)
    {
        $url          = "https://appload.scopevisio.com/api/soap/accounting/PostOutgoingInvoice.write";
        $customer     = \ScopeVisio::getCredentials('customer');
        $user         = \ScopeVisio::getCredentials('username');
        $pass         = \ScopeVisio::getCredentials('password');
        $organisation = \ScopeVisio::getCredentials('organisation');

        $client = new SoapClient(
            null,
            [
                'trace' => true,
                'location' => $url,
                'uri' => "https://www.scopevisio.com/",
            ]
        );

        $stringInvoices = implode(',', $invoices);

        $params =
            "<authn>
                <customer>$customer</customer>
                <user>$user</user>
                <pass>$pass</pass>
                <language>de_DE</language>
                <organisation>$organisation</organisation>
            </authn>
            <config>
                <template></template>
            </config>
            <args>
              <type>1</type>
              <numbers></numbers>
              <legacyDocumentNumbers></legacyDocumentNumbers>
              <documentNumbers>$stringInvoices</documentNumbers>
            </args>";

        $response = $client->req(new SoapVar($params, XSD_ANYXML));

        return $response;
    }
}
