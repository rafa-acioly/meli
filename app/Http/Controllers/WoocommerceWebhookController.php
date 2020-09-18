<?php

namespace App\Http\Controllers;

use App\Http\Requests\WoocommerceProductRequest;

class WoocommerceWebhookController extends Controller
{

    /**
     * Receive a POST request from woocommerce webhooks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WoocommerceProductRequest $request)
    {
        //
    }
}
