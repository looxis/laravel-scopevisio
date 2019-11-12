<?php

namespace Looxis\Laravel\ScopeVisio\Services;

use Looxis\Laravel\ScopeVisio\Services\partials\Product\ProductData;
use SoapClient;
use SoapVar;

class Product
{

    /**
     * @param $number
     * @return array
     */
    public function show($number): array
    {
        $response = \ScopeVisio::client()->get("/product/$number");
        return  json_decode($response->getBody(), true);
    }

    /**
     * @param ProductData $productData
     * @return mixed
     * @throws \SoapFault
     */
    public function store(ProductData $productData)
    {
        $url          = "https://appload.scopevisio.com/api/soap/accounting/Product.create";
        $customer     = \ScopeVisio::getCredentials('customer');
        $user         = \ScopeVisio::getCredentials('username');
        $pass         = \ScopeVisio::getCredentials('password');
        $organisation = \ScopeVisio::getCredentials('organisation');

        $client = new SoapClient(
            null,
            [
                'trace'    => true,
                'location' => $url,
                'uri'      => "https://www.scopevisio.com/",
            ]
        );

        $params =
            "<authn>
                <customer>$customer</customer>
                <user>$user</user>
                <pass>$pass</pass>
                <language>de_DE</language>
                <organisation>$organisation</organisation>
            </authn>
            <args />
            <data>
                {$productData->toString()}
            </data>";

        $response = $client->req( new SoapVar( $params, XSD_ANYXML ) );
        return $response;
    }
}
