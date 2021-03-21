<?php


namespace App\Resources\Woocommerce\Api;


use Illuminate\Support\Facades\Redirect;

class Authorization
{
    const ENDPOINT = '/wc-auth/v1/authorize';

    public static function redirectToPermission(string $storeURL)
    {
        $params = [
            'app_name' => env('APP_NAME'),
            'scope' => 'write',
            'user_id' => auth()->id(),
            'return_url' => route('profile.show'),
            'callback_url' => route('woocommerce.credential')
        ];
        $queryString = http_build_query($params);

        Redirect::away(sprintf('%s%s?%s', $storeURL, self::ENDPOINT, $queryString));
    }
}
