<?php

namespace App\Http\Controllers;

use App\Jobs\WoocommerceProductAttributeSync;
use App\Jobs\WoocommerceProductCategoriesSync;
use App\Jobs\WoocommerceWebhookCreation;
use App\Models\User;
use App\Resources\Woocommerce\Woocommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Crypt;

class WoocommerceCredentialController extends Controller
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

        Bus::chain([
//            WoocommerceWebhookCreation::dispatch($wooClient),
            WoocommerceProductCategoriesSync::dispatch($wooClient),
            WoocommerceProductAttributeSync::dispatch($wooClient),
        ]);

        return response(null);
    }
}
