<?php

namespace App\Http\Controllers;

use App\Jobs\WoocommerceWebhookCreation;
use App\Models\User;
use App\Resources\Woocommerce\Woocommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class WoocommerceCredential extends Controller
{
    /**
     * Receive a POST request from woocommerce containing the store credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keys = $request->only(['consumer_key', 'consumer_secret']);
        $user = User::findOrFail(Crypt::decrypt($request->input('user_id')));
        $user->credential()->update($keys);

        Auth::login($user);
        $wooClient = new Woocommerce($user->credential);

        WoocommerceWebhookCreation::dispatch($wooClient);

        return response(null);
    }
}
