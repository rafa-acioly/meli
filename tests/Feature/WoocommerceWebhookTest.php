<?php

namespace Tests\Feature;

use App\Http\Middleware\WoocommerceWebhook;
use Tests\TestCase;

class WoocommerceWebhookTest extends TestCase
{
    const verbs = ['get', 'post'];

    public function testReturnUnauthorizedForMissingSignature()
    {
        foreach (self::verbs as $verb) {
            $response = $this->$verb('/api/wc/products', []);
            $response->assertUnauthorized();
        }
    }

    public function testReturnUnauthorizedForInvalidSignature()
    {
        foreach (self::verbs as $verb) {
            $response = $this->$verb('/api/wc/products', [], [
                WoocommerceWebhook::SIGNATURE_HEADER_KEY => 'invalid'
            ]);

            $response->assertUnauthorized();
        }
    }
}
