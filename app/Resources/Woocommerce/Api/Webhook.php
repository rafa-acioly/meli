<?php

namespace App\Resources\Woocommerce\Api;

use App\Resources\Woocommerce\Entity\Webhook as WebhookEntity;


class Webhook extends AbstractApi
{
    const ENDPOINT = 'webhooks';

    public function create(string $topic): WebhookEntity
    {
        $webhookType = explode('.', $topic);
        return call_user_func($webhookType[0], $this);
    }

    private function order(): WebhookEntity
    {
        $webhook = $this->client->post(self::ENDPOINT, [
            'name'      => sprintf('%s - order', env('APP_NAME')),
            'topic'     => 'order.update',
            'delivery_url' => route('woocommerce.webhook.order')
        ]);

        $webhook = json_decode($webhook);

        return new WebhookEntity($webhook);
    }

    private function product(): WebhookEntity
    {
        $webhook = $this->client->post(self::ENDPOINT, [
            'name'      => sprintf('%s - product', env('APP_NAME')),
            'topic'     => 'product.update',
            'delivery_url' => route('woocommerce.webhook.product')
        ]);

        $webhook = json_decode($webhook);

        return new WebhookEntity($webhook);
    }

    public function find(int $id): WebhookEntity
    {
        $webhook = $this->client->get(sprintf('%s/%d', self::ENDPOINT, $id));
        $webhook = json_decode($webhook);

        return new WebhookEntity($webhook);
    }
}
