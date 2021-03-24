<?php

namespace App\Http\Controllers\Syncs;

use App\Http\Requests\WoocommerceProductRequest;
use Illuminate\Http\Request;


class WooToMeliProductController extends Controller
{
    /**
     * Receive a post request from woocommerce webhook.
     *
     * @param WoocommerceProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WoocommerceProductRequest $request)
    {
        //
    }

    /**
     * Update the specified product on mercado livre.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
