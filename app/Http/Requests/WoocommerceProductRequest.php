<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WoocommerceProductRequest extends FormRequest
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

    public function messages()
    {
        return [
            'id.exists' => 'the product id was not set for integration yet'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'                => 'required|integer|exists:products,woo_product_sku',
            'name'              => 'required|string',
            'status'            => 'required|string',  // Only allow public products
            'price'             => 'required|numeric',
            'type'              => 'required|string|regex:/simple/',  // Only allow simple products
            'short_description' => 'required|string',
            'description'       => 'required|string',

            'images'            => 'required|array',
            'images.*.src'      => 'required',

            'manage_stock'      => 'required|boolean',
            'stock_status'      => 'required|string|regex:/instock/',  // Ony allow products that are in stock
            // Only necessary if the stock is manageable, a product can be sold with 'unlimited stock'
            'stock_quantity'    => 'required_if:manage_stock,==,true',

            'weight' => 'required|string',
            'dimension.length'  => 'required|string',
            'dimension.width'   => 'required|string',
            'dimension.height'  => 'required|string',

            'categories'        => 'required|array',
            'categories.*.id'   => 'required|integer',
            'categories.*.name' => 'required|string'
        ];
    }
}
