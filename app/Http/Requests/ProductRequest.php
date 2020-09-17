<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'sku'               => 'required|alpha_num',
            'name'              => 'required|string',
            'description'       => 'required|string',
            'pictures'          => 'required|array',
            'category'          => 'required|array',
            'price'             => 'required|numeric',
            'stock_quantity'    => 'required|integer',
            'weight'            => 'required|numeric',
            'length'            => 'required|numeric',
            'width'             => 'required|numeric',
            'height'            => 'required|numeric',
            'shipping_class'    => 'required|alpha_num'
        ];
    }
}
