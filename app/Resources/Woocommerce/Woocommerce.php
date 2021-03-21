<?php


namespace App\Resources\Woocommerce;


use App\Models\Credential;
use App\Resources\Connectors\Service;
use App\Resources\Connectors\ServiceConnector;
use App\Resources\Connectors\WoocommerceConnector;
use App\Resources\Woocommerce\Api\Customer;
use App\Resources\Woocommerce\Api\Order;
use App\Resources\Woocommerce\Api\Product;
use App\Resources\Woocommerce\Api\System;
use Automattic\WooCommerce\Client;

class Woocommerce
{
    const SIGNATURE_HEADER_KEY = 'x-wc-webhook-signature';

    // event name, e.g: updated, created
    const EVENT_KEY = 'x-wc-webhook-event';

    // event type, e.g: product, order
    const EVENT_TYPE_KEY = 'x-wc-webhook-resource';

    private Credential $credential;
    private Client $client;

    public function __construct(Credential $credential)
    {
        $this->credential = $credential;
        $this->client = new Client(
            $credential->store_url,
            $credential->consumer_key,
            $credential->consumer_secret
        );
    }

    public function product(): Product
    {
        return new Product($this->client);
    }

    public function order(): Order
    {
        return new Order();
    }

    public function system(): System
    {
        return new System($this->client);
    }
}
