<?php

namespace Looxis\Laravel\ScopeVisio\models;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\App;
use Looxis\Laravel\ScopeVisio\ScopeVisio;
use RuntimeException;
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

    /** Download pdf file by invoice number
     * @param string $number
     * @return string|BinaryFileResponse
     * @throws GuzzleException
     */
    public function downloadPdf(string $number)
    {
        $url = "https://appload.scopevisio.com/rest/outgoinginvoice/$number/file";
        $pathDir = config('laravel-scopevisio.pdf_storage_files');
        $filePath = $pathDir . '/' . time() . '_' . $number . '.pdf';
        if (!file_exists($pathDir)) {
            mkdir($pathDir, 077, true);
        }
        try {
            $file_path = fopen($filePath,'w');
            $this->scopeVisio->httpClient->request('GET', $url, ['sink' => $file_path]);
        } catch (RuntimeException $exception) {
            unlink($filePath);
            throw new RuntimeException('No outgoing invoice for the given number found or authorization missing');
        }
        return response()->download($filePath);
    }

}