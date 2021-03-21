<?php

namespace App\Http\Controllers;

use App\Jobs\WoocommerceOrderWebhook;
use App\Jobs\WoocommerceProductWebhook;
use App\Models\User;
use App\Resources\Woocommerce\Woocommerce;
use Illuminate\Http\Request;

class WoocommerceCredential extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keys = $request->only(['consumer_key', 'consumer_secret']);
        $user = User::findOrFail($request->input('user_id'));
        $user->credential()->update($keys);

        $wooClient = new Woocommerce($user->credential);

        WoocommerceProductWebhook::dispatch($wooClient)->onQueue('woo_product_webhook_creation');
        WoocommerceOrderWebhook::dispatch($wooClient)->onQueue('woo_order_webhook_creation');

        return response(null);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
