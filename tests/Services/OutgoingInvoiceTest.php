<?php

namespace Looxis\Laravel\ScopeVisio\Tests\Services;

use Looxis\Laravel\ScopeVisio\Services\Partials\OutgoingInvoice\ImportVariables;
use Looxis\Laravel\ScopeVisio\Services\Partials\OutgoingInvoice\ImportXml;
use Looxis\Laravel\ScopeVisio\Tests\LaravelTest;

class OutgoingInvoiceTest extends LaravelTest
{
    /** Example data for creating outgoing invoice
     * @var array
     */
    private $formParams;

    /**
     * @var ImportVariables $importVariables
     */
    private $importVariables;

    /**
     * @var ImportXml
     */
    private $importXml;

    protected function setUp(): void
    {
        parent::setUp();
        $year = date('Y');
        $this->importVariables = (new ImportVariables())
            ->setGenerateDocumentNumbers(true)
            ->setDoPost(true)
            ->setSkipDuplicates(false)
            ->setCreatePdf(true)
            ->setCopyProductToPosition(false)
            ->setCopyProductToPositionOverwriteMode(false)
            ->setCopyImpersonalAccountFieldsToPosition(false);
        $this->importXml = (new ImportXml())
            ->setCustomer([
                'account' => '10000',
                'accountname' => 'Some Name'
            ])
            ->setInvoice([
                'documentNumber' => 'RE-' . $year,
                'customer' => '10000',
                'documentDate' => now()->format('d.m.Y'),
                'grossBased' => 'false',
                'currency' => 'EUR',
                'language' => 'de',
                'text' => 'invoiceDesc',
                'documentText' => 'Rechnung',
                'endDiscount' => '0.00',
                'isEndDiscountAbsolute' => 'true'
            ])
        ->setInvoiceDescription('invoice description')
        ->setInvoiceTextsTitle('Rechnung')
        ->setInvoiceTextsSubtitle('$Belegnummer')
        ->setInvoiceTextsIntro('$Anrede $Kunde_Titel $Kunde_Vorname $Kunde_Nachname, wir erlauben uns, Ihnen wie folgt in Rechnung zu stellen:')
        ->setInvoiceTextsExtro('Zahlungsbedingung: Zahlbar sofort per $Rechnung_Fälligkeit, netto.')
        ->setInvoiceAddress([
            'selectedAddress' => 'Adresse',
            'otherAddress' => 'Testorganisation GmbH, Straße 1, 12345 Berlin, Deutschland'
        ])
        ->setInvoicePayment([
            'paidOnExport' => 'false',
            'explicitDiscount' => 'false'
        ])
        ->addLine([
            'positionType' => 'PRODUCT',
            'productNumber' => 'P 04',
            'unit' => 'Stück',
            'discount' => '0.00',
            'vatkey' => 'U19',
            'taxrate' => '0',
            'netItemPrice' => '10.0',
            'grossItemPrice' => '10.00',
            'quantity' => '10.00',
            'account' => '8400',
            'asIfSold' => 'false'
        ],
        'Sonstige Produkte',
        'Meine Beschreibung'
        )
        ->setTotals(
            [
                'netAmount' => '100.00',
                'grossAmount' => '100.00'
            ],
            [
                'taxrate' => '0',
                'taxamount' => '0'
            ]
        );
    }

    /** @test */
    public function import()
    {
        $response = \ScopeVisio::outgoingInvoice()->import($this->importVariables, $this->importXml);
        $this->assertArrayHasKey('invoices', $response);
        $this->assertArrayHasKey('message', $response);
    }


    /** @test */
    public function show()
    {
        $response = \ScopeVisio::outgoingInvoice()->import($this->importVariables, $this->importXml);
        $number = array_get($response, 'invoices.0.documentNumber');
        $response = \ScopeVisio::outgoingInvoice()->show($number);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('documentNumber', $response);
    }

    /** @test */
    public function download_file()
    {
        $fileName = 'test.pdf';
        \Route::get('test', function () use ($fileName) {
            $response = \ScopeVisio::outgoingInvoice()->import($this->importVariables, $this->importXml);
            $documentNumber = data_get($response, 'invoices.0.documentNumber');
            return \ScopeVisio::outgoingInvoice()->downloadFile($documentNumber, $fileName);
        });
        $response = $this->get('test');
        $response->assertHeader('Content-Disposition', "attachment; filename=test.pdf");
        //\Storage::put('test.pdf', $response->streamedContent());
    }
}
