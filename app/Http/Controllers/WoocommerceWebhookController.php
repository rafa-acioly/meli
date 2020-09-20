<?php

namespace App\Http\Controllers;

use App\Http\Requests\WoocommerceProductRequest;

class WoocommerceWebhookController extends Controller
{
    protected const EVENT_KEY = 'x-wc-webhook-event';
    protected const EVENT_TYPE_KEY = 'x-wc-webhook-resource';
    
    /**
     * Receive a POST request from woocommerce webhooks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WoocommerceProductRequest $request)
    {
        // event name, e.g: updated, created
        $event = $request->header(self::EVENT_KEY);

        // event type, e.g: product, order
        $eventType = $request->header(self::EVENT_TYPE_KEY);
    }
}
