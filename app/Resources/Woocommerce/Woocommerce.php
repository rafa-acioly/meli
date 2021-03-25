<?php


namespace App\Resources\Woocommerce;


use App\Models\Credential;
use App\Resources\Connectors\Service;
use App\Resources\Connectors\ServiceConnector;
use App\Resources\Connectors\WoocommerceConnector;
use App\Resources\Woocommerce\Api\Attribute;
use App\Resources\Woocommerce\Api\Authorization;
use App\Resources\Woocommerce\Api\Category;
use App\Resources\Woocommerce\Api\Customer;
use App\Resources\Woocommerce\Api\Order;
use App\Resources\Woocommerce\Api\Product;
use App\Resources\Woocommerce\Api\System;
use App\Resources\Woocommerce\Api\Webhook;
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
            $credential->consumer_secret,
            [
                'wp_api' => true,
                'version' => 'wc/v3',
                'verify_ssl' => false,
            ]
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

    public function webhook(): Webhook
    {
        return new Webhook($this->client);
    }

    public function category(): Category
    {
        return new Category($this->client);
    }

    public function attribute()
    {
        return new Attribute($this->client);
    }

    public static function authorization(string $storeURL): void
    {
        Authorization::redirectToPermission($storeURL);
    }
}
