<?php

namespace Looxis\Laravel\ScopeVisio\Tests\Services;

use Looxis\Laravel\ScopeVisio\Tests\LaravelTest;

class OutgoingInvoiceTest extends LaravelTest
{
    /** Example data for creating outgoing invoice
     * @var array
     */
    private $formParams;

    protected function setUp(): void
    {
        parent::setUp();
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
                            <text>$Belegnummer</text>
                        </subtitle>
                        <intro>
                            <text>$Anrede $Kunde_Titel $Kunde_Vorname $Kunde_Nachname, wir erlauben uns, Ihnen wie folgt in Rechnung zu stellen:</text>
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
     * @test
     */
    public function doPostTest()
    {
        $invoices = [
            'RE-2019-2'
        ];
        $response = \ScopeVisio::outgoingInvoice()->doPost($invoices);
        $this->assertObjectHasAttribute('invoice', $response);
        $this->assertObjectHasAttribute('success', $response->invoice);
    }

    /** @test */
    public function import()
    {
        $response = \ScopeVisio::outgoingInvoice()->import($this->formParams);
        $this->assertArrayHasKey('invoices', $response);
        $this->assertArrayHasKey('message', $response);
    }


    /** @test */
    public function show()
    {
        $response = \ScopeVisio::outgoingInvoice()->import($this->formParams);
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
            $response = \ScopeVisio::outgoingInvoice()->import($this->formParams);
            $documentNumber = data_get($response, 'invoices.0.documentNumber');
            return \ScopeVisio::outgoingInvoice()->downloadFile($documentNumber, $fileName);
        });
        $response = $this->get('test');
        $response->assertHeader('Content-Disposition', "attachment; filename=test.pdf");
        //\Storage::put('test.pdf', $response->streamedContent());
    }
}
