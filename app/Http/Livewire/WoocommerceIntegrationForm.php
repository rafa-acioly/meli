<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WoocommerceIntegrationForm extends Component
{
    public string $url;

    public function render()
    {
        $storeURL = "http://aciolycom.test/wc-auth/v1/authorize";
        $params = [
            'app_name'     => env('APP_NAME'),
            'scope'        => 'read|write',
            'user_id'      => Auth::id(),
            'return_url'   => 'https://app.com',
            'callback_url' => 'https://app.com'
        ];
        $this->url = $storeURL . '?' . http_build_query($params);

        return view('livewire.woocommerce-integration-form');
    }
}
