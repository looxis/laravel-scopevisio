<?php

namespace Looxis\Laravel\ScopeVisio\Services\partials\Product;

class ProductData
{
    /**
     * @var array
     */
    private $data;

    /**
     * ProductData constructor.
     * SOAP route documentation: https://www.openscope.de/api.html#import-von-produkten
     */
    public function __construct()
    {
        $this->data = [];
        for ($i = 0; $i < 44; $i++) {
            $this->data[] = '';
        }
    }

    /**
     * @param string $productNumber
     * @return ProductData
     */
    public function setProductNumber(string $productNumber): ProductData
    {
        $this->data[0] = $productNumber;
        return $this;
    }

    /**
     * @param string $productGroup
     * @return ProductData
     */
    public function setProductGroup(string $productGroup): ProductData
    {
        $this->data[1] = $productGroup;
        return $this;
    }

    /**
     * @param string $name1
     * @return ProductData
     */
    public function setName1(string $name1): ProductData
    {
        $this->data[2] = $name1;
        return $this;
    }

    /**
     * @param string $description1
     * @return ProductData
     */
    public function setDescription1(string $description1): ProductData
    {
        $this->data[3] = $description1;
        return $this;
    }

    /**
     * @param string $name2
     * @return ProductData
     */
    public function setName2(string $name2): ProductData
    {
        $this->data[4] = $name2;
        return $this;
    }

    /**
     * @param string $description2
     * @return ProductData
     */
    public function setDescription2(string $description2): ProductData
    {
        $this->data[5] = $description2;
        return $this;
    }

    /**
     * @param string $name3
     * @return ProductData
     */
    public function setName3(string $name3): ProductData
    {
        $this->data[6] = $name3;
        return $this;
    }

    /**
     * @param string $description3
     * @return ProductData
     */
    public function setDescription3(string $description3): ProductData
    {
        $this->data[7] = $description3;
        return $this;
    }

    /**
     * @param string $name4
     * @return ProductData
     */
    public function setName4(string $name4): ProductData
    {
        $this->data[8] = $name4;
        return $this;
    }

    /**
     * @param string $description4
     * @return ProductData
     */
    public function setDescription4(string $description4): ProductData
    {
        $this->data[9] = $description4;
        return $this;
    }

    /**
     * @param string $name5
     * @return ProductData
     */
    public function setName5(string $name5): ProductData
    {
        $this->data[10] = $name5;
        return $this;
    }

    /**
     * @param string $description5
     * @return ProductData
     */
    public function setDescription5(string $description5): ProductData
    {
        $this->data[11] = $description5;
        return $this;
    }

    /**
     * @param string $productType
     * @return ProductData
     */
    public function setProductType(string $productType): ProductData
    {
        $this->data[12] = $productType;
        return $this;
    }

    /**
     * @param string $unit
     * @return ProductData
     */
    public function setUnit(string $unit): ProductData
    {
        $this->data[13] = $unit;
        return $this;
    }

    /**
     * @param string $priceGroup1
     * @return ProductData
     */
    public function setPriceGroup1(string $priceGroup1): ProductData
    {
        $this->data[14] = $priceGroup1;
        return $this;
    }

    /**
     * @param string $priceGroup2
     * @return ProductData
     */
    public function setPriceGroup2(string $priceGroup2): ProductData
    {
        $this->data[15] = $priceGroup2;
        return $this;
    }

    /**
     * @param string $priceGroup3
     * @return ProductData
     */
    public function setPriceGroup3(string $priceGroup3): ProductData
    {
        $this->data[16] = $priceGroup3;
        return $this;
    }

    /**
     * @param bool $standardRevenueAccount
     * @return ProductData
     */
    public function setStandardRevenueAccount(bool $standardRevenueAccount): ProductData
    {
        $this->data[17] = $standardRevenueAccount;
        return $this;
    }

    /**
     * @param int $taxRate
     * 0 => No VAT
     * 7 => 7% VAT
     * 19 => 19% VAT.
     * @return ProductData
     */
    public function setTaxRate(int $taxRate): ProductData
    {
        $this->data[18] = $taxRate;
        return $this;
    }

    /**
     * @param string $revenueDomestic
     * @return ProductData
     */
    public function setRevenueAccountDomestic(string $revenueDomestic): ProductData
    {
        $this->data[19] = $revenueDomestic;
        return $this;
    }

    /**
     * @param string $revenueEU
     * @return ProductData
     */
    public function setRevenueAccountEU(string $revenueEU): ProductData
    {
        $this->data[20] = $revenueEU;
        return $this;
    }

    /**
     * @param string $revenueAbroad
     * @return ProductData
     */
    public function setRevenueAccountAbroad(string $revenueAbroad): ProductData
    {
        $this->data[21] = $revenueAbroad;
        return $this;
    }

    /**
     * @param float $grossPriceG1
     * @return ProductData
     */
    public function setGrossPriceGroup1(float $grossPriceG1): ProductData
    {
        $this->data[22] = $grossPriceG1;
        return $this;
    }

    /**
     * @param float $grossPriceG2
     * @return ProductData
     */
    public function setGrossPriceGroup2(float $grossPriceG2): ProductData
    {
        $this->data[23] = $grossPriceG2;
        return $this;
    }

    /**
     * @param float $grossPriceG3
     * @return ProductData
     */
    public function setGrossPriceGroup3(float $grossPriceG3): ProductData
    {
        $this->data[24] = $grossPriceG3;
        return $this;
    }

    /**
     * @param float $purchasingPrice
     * @return ProductData
     */
    public function setPurchasingPrice(float $purchasingPrice): ProductData
    {
        $this->data[25] = $purchasingPrice;
        return $this;
    }

    /**
     * @param float $realPurchasingPrice
     * @return ProductData
     */
    public function setRealPurchasePrice(float $realPurchasingPrice): ProductData
    {
        $this->data[26] = $realPurchasingPrice;
        return $this;
    }

    /**
     * @param float $catalogPrice
     * @return ProductData
     */
    public function setCatalogPrice(float $catalogPrice): ProductData
    {
        $this->data[27] = $catalogPrice;
        return $this;
    }

    /**
     * @param string $manufacturerNumber
     * @return ProductData
     */
    public function setManufacturerNumber(string $manufacturerNumber): ProductData
    {
        $this->data[28] = $manufacturerNumber;
        return $this;
    }

    /**
     * @param string $tradingPlatformNumber
     * @return ProductData
     */
    public function setTradingPlatformNumber(string $tradingPlatformNumber): ProductData
    {
        $this->data[29] = $tradingPlatformNumber;
        return $this;
    }

    /**
     * @param string $ean
     * @return ProductData
     */
    public function setEAN(string $ean): ProductData
    {
        $this->data[30] = $ean;
        return $this;
    }

    /**
     * @param string $group
     * @return ProductData
     */
    public function setGroup(string $group): ProductData
    {
        $this->data[31] = $group;
        return $this;
    }

    /**
     * @param string $weight
     * @return ProductData
     */
    public function setWeight(string $weight): ProductData
    {
        $this->data[32] = $weight;
        return $this;
    }

    /**
     * @param string $height
     * @return ProductData
     */
    public function setHeight(string $height): ProductData
    {
        $this->data[33] = $height;
        return $this;
    }

    /**
     * @param string $data
     * @return ProductData
     */
    public function setWidth(string $data): ProductData
    {
        $this->data[34] = $data;
        return $this;
    }

    /**
     * @param string $depth
     * @return ProductData
     */
    public function setDepth(string $depth): ProductData
    {
        $this->data[35] = $depth;
        return $this;
    }

    /**
     * @param string $volume
     * @return ProductData
     */
    public function setVolume(string $volume): ProductData
    {
        $this->data[36] = $volume;
        return $this;
    }

    /**
     * @param string $packageUnit
     * @return ProductData
     */
    public function setPackagingUnit(string $packageUnit): ProductData
    {
        $this->data[37] = $packageUnit;
        return $this;
    }

    /**
     * @param string $palletQuantity
     * @return ProductData
     */
    public function setPalletQuantity(string $palletQuantity): ProductData
    {
        $this->data[38] = $palletQuantity;
        return $this;
    }

    /**
     * @param string $camp
     * @return ProductData
     */
    public function setCamp(string $camp): ProductData
    {
        $this->data[39] = $camp;
        return $this;
    }

    /**
     * @param string $logisticians
     * @return ProductData
     */
    public function setLogisticians(string $logisticians): ProductData
    {
        $this->data[40] = $logisticians;
        return $this;
    }

    /**
     * @param string $manufacturer
     * @return ProductData
     */
    public function setManufacturer(string $manufacturer): ProductData
    {
        $this->data[41] = $manufacturer;
        return $this;
    }

    /**
     * @param string $series
     * @return ProductData
     */
    public function setSeries(string $series): ProductData
    {
        $this->data[42] = $series;
        return $this;
    }

    /**
     * @param string $technicalDescription
     * @return ProductData
     */
    public function setTechnicalDescription(string $technicalDescription): ProductData
    {
        $this->data[43] = $technicalDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return implode(';', $this->data);
    }

}
