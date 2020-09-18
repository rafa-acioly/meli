<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WoocommerceOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'                    => 'required|integer',
            'status'                => 'required|string',

            'billing'               => 'required',
            'billing.address_1'     => 'required|string',
            'billing.address_2'     => 'required|string',
            'billing.address'       => 'required|string',
            'billing.country'       => 'required|string',
            'billing.email'         => 'required|email',
            'billing.first_name'    => 'required|string',
            'billing.last_name'     => 'required|string',
            'billing.phone'         => 'required|string',
            'billing.postcode'      => 'required|string',
            'billing.state'         => 'required|string',

            'shipping'              => 'required',
            'shipping.address_1'    => 'required|string',
            'shipping.address_2'    => 'required|string',
            'shipping.city'         => 'required|string',
            'shipping.country'      => 'required|string',
            'shipping.first_name'   => 'required|string',
            'shipping.last_name'    => 'required|string',
            'shipping.postcode'     => 'required|string',
            'shipping.state'        => 'required|string',

        ];
    }
}
