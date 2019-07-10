<?php

namespace Looxis\Laravel\ScopeVisio\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\App;
use Looxis\Laravel\ScopeVisio\ScopeVisio;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OutgoingInvoice
{
    /**
     * @var ScopeVisio
     */
    protected $scopeVisio;

    /**
     * OutgoingInvoice constructor.
     */
    public function __construct()
    {

        $this->scopeVisio = App::make(ScopeVisio::class);
    }

    /**
     * @param array $formParams
     * @return string
     * @throws GuzzleException
     */
    public function createInvoice(array $formParams):string
    {
        $url = 'https://appload.scopevisio.com/rest/outgoinginvoices/import';
        $response = $this->scopeVisio->httpClient->request('POST', $url, [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json'
            ],
            RequestOptions::JSON => $formParams
        ]);
        return $response->getBody()->getContents();

    }


    /** Download pdf file by invoice number
     * @param string $number
     * @return BinaryFileResponse
     * @throws GuzzleException
     */
    public function downloadPdf(string $number): BinaryFileResponse
    {
        $url = "https://appload.scopevisio.com/rest/outgoinginvoice/$number/file";
        $pathDir = config('scopevisio.pdf_storage_files');
        $filePath = $pathDir . '/' . time() . '_' . $number . '.pdf';
        if (!file_exists($pathDir)) {
            mkdir($pathDir, 077, true);
        }
        $file_path = fopen($filePath,'w');
        $this->scopeVisio->httpClient->request('GET', $url, [
            'sink' => $file_path,
        ]);
        return response()->download($filePath);
    }

}