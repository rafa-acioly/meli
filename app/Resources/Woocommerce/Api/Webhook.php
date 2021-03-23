<?php

namespace App\Resources\Woocommerce\Api;

use App\Resources\Woocommerce\Entity\Webhook as WebhookEntity;
use App\Resources\Woocommerce\Enum\WebhookType;
use Illuminate\Support\Facades\Log;


class Webhook extends AbstractApi
{
    const ENDPOINT = 'webhooks';

    public function createOrder(): WebhookEntity
    {
        $webhook = $this->client->post(self::ENDPOINT, [
            'name'          => sprintf('%s - order', env('APP_NAME')),
            'topic'         => 'order.updated',
            'delivery_url'  => route('woocommerce.webhook.order')
        ]);

        return new WebhookEntity($webhook);
    }

    public function createProduct(): WebhookEntity
    {
        $webhook = $this->client->post(self::ENDPOINT, [
            'name'          => sprintf('%s - product', env('APP_NAME')),
            'topic'         => 'product.updated',
            'delivery_url'  => route('woocommerce.webhook.product')
        ]);

        return new WebhookEntity($webhook);
    }

    public function find(int $id): WebhookEntity
    {
        $webhook = $this->client->get(sprintf('%s/%d', self::ENDPOINT, $id));
        $webhook = json_decode($webhook);

        return new WebhookEntity($webhook);
    }
}