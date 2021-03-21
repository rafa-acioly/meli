<?php

namespace App\Resources\Woocommerce\Api;

use App\Resources\Woocommerce\Entity\AbstractEntity;


class Webhook extends AbstractEntity
{
    const ENDPOINT = 'webhooks';

    public function create(string $topic)
    {
        $webhookType = explode('.', $topic);
        return call_user_func($webhookType[0], $this);
    }

    private function order(): array
    {
        return $this->client->post(self::ENDPOINT, [
            'name'      => sprintf('%s - order', env('APP_NAME')),
            'topic'     => 'order.update',
            'delivery_url' => route('woocommerce.webhook.order')
        ]);
    }

    private function product(): array
    {
        return $this->client->post(self::ENDPOINT, [
            'name'      => sprintf('%s - product', env('APP_NAME')),
            'topic'     => 'product.update',
            'delivery_url' => route('woocommerce.webhook.product')
        ]);
    }
}
