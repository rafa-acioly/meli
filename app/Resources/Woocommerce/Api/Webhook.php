<?php

namespace App\Resources\Woocommerce\Api;

use App\Resources\Woocommerce\Entity\Webhook as WebhookEntity;
use App\Resources\Woocommerce\Enum\WebhookType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;


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

        return new WebhookEntity($webhook);
    }

    public function batch()
    {
        $userIDEncrypted = ['user_id' => Crypt::encrypt(Auth::id())];
        $data = [
            'create' => [
                [
                    'name'          => sprintf('%s - order', env('APP_NAME')),
                    'topic'         => 'order.updated',
                    'delivery_url'  => route('woocommerce.webhook.order', $userIDEncrypted)
                ],
                [
                    'name'          => sprintf('%s - product', env('APP_NAME')),
                    'topic'         => 'product.updated',
                    'delivery_url'  => route('woocommerce.webhook.product', $userIDEncrypted)
                ]
            ]
        ];

        $this->client->post(self::ENDPOINT . '/batch', $data);
    }
}
