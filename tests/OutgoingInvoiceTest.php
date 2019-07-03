<?php

namespace Looxis\Laravel\ScopeVisio\Tests;

use Looxis\Laravel\ScopeVisio\Services\OutgoingInvoice;
use Orchestra\Testbench\TestCase;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OutgoingInvoiceTest extends TestCase
{

    /**
     * @var OutgoingInvoice
     */
    private $outgoingInvoice;

    /** Example data for creating outgoing invoice
     * @var array
     */
    private $formParams;

    protected function setUp(): void
    {
        parent::setUp();
        $this->outgoingInvoice = $this->app->make(OutgoingInvoice::class);
        $year = date('Y');
        $this->formParams = [
            "generateDocumentNumbers" => true,
            "doPost" => true,
            "skipDuplicates" => false,
            "createPdf" => true,
            "copyProductToPosition" => false,
            "copyProductToPositionOverwriteMode" => false,
            "copyImpersonalAccountFieldsToPosition" => false,
            "data" => '<?xml version="1.0" encoding="UTF-8"?>
<fakturaimport xmlns="scopevisio.com/accounting/fakturaimport" version="2">
    <customer account="10000" accountname="Some Name" />
    <invoice documentNumber="RE-' . $year . '" customer="10000" documentDate="12.05.2019" grossBased="false"
             currency="EUR" language="de" text="invoiceDesc" documentText="Rechnung" endDiscount="0.00" isEndDiscountAbsolute="true">
        <description>
            <text>invoiceDesc</text>
        </description>
        <texts>
            <title>
                <text>Rechnung</text>
            </title>
            <subtitle>
                <text>$Belegnumme</text>
            </subtitle>
            <intro>
                <text>$Anrede $Kunde_Titel $Kunde_Vorname $Kunde_Nachname,wir erlauben uns, Ihnen wie folgt in Rechnung zu stellen:</text>
            </intro>
            <extro>
                <text>Zahlungsbedingung: Zahlbar sofort per $Rechnung_Fälligkeit, netto.</text>
            </extro>
        </texts>
        <address selectedAddress="Adresse"  otherAddress="Testorganisation GmbH, Straße 1, 12345 Berlin, Deutschland" />
        <payment paidOnExport="false" explicitDiscount="false"/>
        <delivery/>
        <lines>
            <line positionType="PRODUCT" productNumber="P 04" unit="Stück" discount="0.00" vatkey="U19" taxrate="0"
                  netItemPrice="10.00" grossItemPrice="10.00" quantity="10.00" account="8400" asIfSold="false">
                <text>Sonstige Produkte</text>
                <description>Meine Beschreibung</description>
            </line>
        </lines>
        <totals netAmount="100.00" grossAmount="100.00">
            <vat taxrate="0" taxamount="0"/>
        </totals>
    </invoice>
</fakturaimport>'
        ];
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCreateInvoice()
    {
        $response = $this->outgoingInvoice->createInvoice($this->formParams);
        $this->assertJson($response);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testDownloadPdfFile()
    {
        $message = json_decode($this->outgoingInvoice->createInvoice($this->formParams));
        $documentNumber = $message->invoices[0]->documentNumber;
        $response = $this->outgoingInvoice->downloadPdf($documentNumber);
        $this->assertInstanceOf(BinaryFileResponse::class, $response);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('scopevisio.customer', 'test_customer');
        $app['config']->set('scopevisio.username', 'test@email.com');
        $app['config']->set('scopevisio.password', 'test_password');
        $app['config']->set('scopevisio.pdf_storage_files',  __DIR__ . '/storage/pdf');
    }
}