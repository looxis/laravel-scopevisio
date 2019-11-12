<?php


namespace Looxis\Laravel\ScopeVisio\Tests\Services;


use Looxis\Laravel\ScopeVisio\Services\partials\Product\ProductData;
use Looxis\Laravel\ScopeVisio\Services\Product;
use Looxis\Laravel\ScopeVisio\Tests\LaravelTest;

class ProductTest extends LaravelTest
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var ProductData
     */
    private $productData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->product = new Product();
        $this->productData = (new ProductData())
            ->setProductNumber('new_sku_1')
            ->setProductGroup('product_group')
            ->setName1('name_1')
            ->setUnit('Stück')
            ->setPriceGroup1('4,61')
            ->setTaxRate(19)
            ->setGrossPriceGroup1(5.49)
            ->setPurchasingPrice(3.16)
            ->setCamp(1)
            ->setSeries('DEHAEL');
    }


    /**
     * @test
     * @throws \SoapFault
     */
    public function storeProductTest()
    {

        $response = $this->product->store($this->productData);
        $this->assertArrayHasKey('insertCount', $response);
        $this->assertArrayHasKey('updateCount', $response);
        $this->assertArrayHasKey('errors', $response);
    }

    /**
     * @test
     */
    public function showProductTest()
    {
        //TODO write test
    }
}
