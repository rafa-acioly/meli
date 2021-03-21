<?php


namespace App\Resources\Woocommerce\Api;


use Automattic\WooCommerce\Client;

abstract class AbstractApi
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
