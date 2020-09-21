<?php

namespace App\Http\Controllers;
use App\Resources\Woocommerce;
use Illuminate\Http\Response;

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
        $event = $request->header(Woocommerce::EVENT_KEY);
        $eventType = $request->header(Woocommerce::EVENT_TYPE_KEY);

        return response()->json([
            'event' => $event,
            'type' => $eventType
        ], Response::HTTP_OK);
    }
}
