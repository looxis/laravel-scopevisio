<?php

namespace Looxis\Laravel\ScopeVisio\Services\Partials\OutgoingInvoice;

use SimpleXMLElement;

class ImportXml
{
    /**
     * @var SimpleXMLElement $simpleXmlElement
     */
    private $simpleXmlElement;

    /**
     * @var SimpleXMLElement $customer
     */
    private $customer;

    /**
     * @var SimpleXMLElement $invoice
     */
    private $invoice;

    /**
     * @var SimpleXMLElement $invoiceDescription
     */
    private $invoiceDescription;

    /**
     * @var SimpleXMLElement $invoiceTexts
     */
    private $invoiceTexts;

    /**
     * @var SimpleXMLElement $invoiceTextsTitle
     */
    private $invoiceTextsTitle;

    /**
     * @var SimpleXMLElement $invoiceTextsSubtitle
     */
    private $invoiceTextsSubtitle;

    /**
     * @var SimpleXMLElement $invoiceTextsIntro
     */
    private $invoiceTextsIntro;

    /**
     * @var SimpleXMLElement $invoiceTextsExtro
     */
    private $invoiceTextsExtro;

    /**
     * @var SimpleXMLElement $invoiceAddress
     */
    private $invoiceAddress;

    /**
     * @var SimpleXMLElement $invoicePayment
     */
    private $invoicePayment;

    /**
     * @var SimpleXMLElement $invoiceDelivery
     */
    private $invoiceDelivery;

    /**
     * @var SimpleXMLElement $lines
     */
    private $lines;

    /**
     * @var SimpleXMLElement $totals
     */
    private $totals;

    /**
     * ImportXml constructor.
     *
     * All available attributes:
     * https://www.openscope.de/api.html#import-von-ausgangsrechnungen
     */
    public function __construct()
    {
        $this->simpleXmlElement = new SimpleXMLElement(file_get_contents('sample.xml', true));
        $this->simpleXmlElement->addAttribute('xmlns', 'scopevisio.com/accounting/fakturaimport');
        $this->invoice = $this->simpleXmlElement->invoice;
        $this->lines = $this->invoice->lines;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getCustomer(): SimpleXMLElement
    {
        if (!$this->customer) {
            $this->customer = $this->simpleXmlElement->addChild('customer');
        }
        return $this->customer;
    }

    /**
     * @param array $attributes
     * @return ImportXml
     */
    public function setCustomer(array $attributes): ImportXml
    {
        $customer = $this->getCustomer();
        foreach ($attributes as $key => $value) {
            $customer->addAttribute($key, $value);
        }
        return $this;
    }

    /**
     * @param array $attributes
     * @return ImportXml
     */
    public function setInvoice(array $attributes): ImportXml
    {
        foreach ($attributes as $key => $value) {
            $this->invoice->addAttribute($key, $value);
        }
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getInvoiceDescription(): SimpleXMLElement
    {
        if (!$this->invoiceDescription) {
            $this->invoiceDescription = $this->invoice->addChild('description');
        }
        return $this->invoiceDescription;
    }

    /**
     * @param string $text
     * @return ImportXml
     */
    public function setInvoiceDescription(string $text): ImportXml
    {
        $this->getInvoiceDescription()->addChild('text', $text);
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getInvoiceTexts(): SimpleXMLElement
    {
        if (!$this->invoiceTexts) {
            $this->invoiceTexts = $this->invoice->addChild('texts');
        }
        return $this->invoiceTexts;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getInvoiceTextsTitle(): SimpleXMLElement
    {
        if (!$this->invoiceTextsTitle) {
            $this->invoiceTextsTitle = $this->getInvoiceTexts()->addChild('title');
        }
        return $this->invoiceTextsTitle;
    }

    /**
     * @param string $text
     * @return ImportXml
     */
    public function setInvoiceTextsTitle(string $text): ImportXml
    {
        $this->getInvoiceTextsTitle()->addChild('text', $text);
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getInvoiceTextsSubtitle(): SimpleXMLElement
    {
        if (!$this->invoiceTextsSubtitle) {
            $this->invoiceTextsSubtitle = $this->getInvoiceTexts()->addChild('subtitle');
        }
        return $this->invoiceTextsSubtitle;
    }

    /**
     * @param string $text
     * @return ImportXml
     */
    public function setInvoiceTextsSubtitle(string $text): ImportXml
    {
        $this->getInvoiceTextsSubtitle()->addChild('text', $text);
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getInvoiceTextsIntro(): SimpleXMLElement
    {
        if (!$this->invoiceTextsIntro) {
            $this->invoiceTextsIntro = $this->getInvoiceTexts()->addChild('intro');
        }
        return $this->invoiceTextsIntro;
    }

    /**
     * @param string $text
     * @return ImportXml
     */
    public function setInvoiceTextsIntro(string $text): ImportXml
    {
        $this->getInvoiceTextsIntro()->addChild('text', $text);
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getInvoiceTextsExtro(): SimpleXMLElement
    {
        if (!$this->invoiceTextsExtro) {
            $this->invoiceTextsExtro = $this->getInvoiceTexts()->addChild('extro');
        }
        return $this->invoiceTextsExtro;
    }

    /**
     * @param string $text
     * @return ImportXml
     */
    public function setInvoiceTextsExtro(string $text): ImportXml
    {
        $this->getInvoiceTextsExtro()->addChild('text', $text);
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getInvoiceAddress(): SimpleXMLElement
    {
        if (!$this->invoiceAddress) {
            $this->invoiceAddress = $this->invoice->addChild('address');
        }
        return $this->invoiceAddress;
    }

    /**
     * @param array $attributes
     * @return ImportXml
     */
    public function setInvoiceAddress(array $attributes): ImportXml
    {
        $invoiceAddress = $this->getInvoiceAddress();
        foreach ($attributes as $key => $value) {
            $invoiceAddress->addAttribute($key, $value);
        }
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getInvoicePayment(): SimpleXMLElement
    {
        if (!$this->invoicePayment) {
            $this->invoicePayment = $this->invoice->addChild('payment');
        }
        return $this->invoicePayment;
    }

    /**
     * @param array $attributes
     * @return ImportXml
     */
    public function setInvoicePayment(array $attributes): ImportXml
    {
        $invoicePayment = $this->getInvoicePayment();
        foreach ($attributes as $key => $value) {
            $invoicePayment->addAttribute($key, $value);
        }
        return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getInvoiceDelivery(): SimpleXMLElement
    {
        if (!$this->invoiceDelivery) {
            $this->invoiceDelivery = $this->invoice->addChild('delivery');
        }
        return $this->invoiceDelivery;
    }

    /**
     * @param array $attributes
     * @return ImportXml
     */
    public function setInvoiceDelivery(array $attributes): ImportXml
    {
        $invoiceDelivery = $this->getInvoiceDelivery();
        foreach ($attributes as $key => $value) {
            $invoiceDelivery->addAttribute($key, $value);
        }
        return $this;
    }

    /**
     * @param array $attributes
     * @param string|null $text
     * @param string|null $description
     * @return ImportXml
     */
    public function addLine(array $attributes, string $text = null, string $description = null): ImportXml
    {
        $newLine = $this->lines->addChild('line');
        foreach ($attributes as $key => $value) {
            $newLine->addAttribute($key, $value);
        }
        if ($text) {
            $newLine->addChild('text', $text);
        }
        if ($description) {
            $newLine->addChild('description', $description);
        }
         return $this;
    }

    /**
     * @return SimpleXMLElement
     */
    protected function getTotals(): SimpleXMLElement
    {
        if (!$this->totals) {
            $this->totals = $this->invoice->addChild('totals');
        }
        return $this->totals;
    }

    /**
     * @param array $attributes
     * @param array|null $vatAttributes
     * @return ImportXml
     */
    public function setTotals(array $attributes, array $vatAttributes = null): ImportXml
    {
        $totals = $this->getTotals();
        foreach ($attributes as $key => $value) {
            $totals->addAttribute($key, $value);
        }
        if ($vatAttributes) {
            $vat = $totals->addChild('vat');
            foreach ($vatAttributes as $key => $value) {
                $vat->addAttribute($key, $value);
            }
        }
        return $this;
    }

    public function toString(): string
    {
        return $this->simpleXmlElement->asXML();
    }

}
