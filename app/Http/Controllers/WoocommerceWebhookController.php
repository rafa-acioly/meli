<?php

namespace App\Http\Controllers;
use App\Entities\WoocommerceProduct;
use App\Resources\Woocommerce;

use App\Http\Requests\WoocommerceProductRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

        $product = new WoocommerceProduct($request->all());
        $meli = new Meli('APP-ID', 'SECRET-ID');
        $auth = new AuthorizationService($meli);
        $announcement = new Announcement($auth);

        $productData = [
            'title' => $product->getTitle(),
            'available_quantity' => $product->getAvailableQuantity(),
            'price' => $product->getPrice(),
        ];

        $integratedProduct = Auth::user()->products()->where('woo_product_id', $product->id);
        $response = $announcement->update($integratedProduct->meli_product_id, $productData);

        return response()->json([
            'permalink' => $response->getPermalink(),
        ], Response::HTTP_ACCEPTED);
    }
}
