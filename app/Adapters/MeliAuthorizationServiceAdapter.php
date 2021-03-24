<?php


namespace App\Adapters;


use Dsc\MercadoLivre\Resources\Authorization\AuthorizationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MeliAuthorizationServiceAdapter extends AuthorizationService
{

    public function getOAuthUrl($redirectUri): string
    {
        $meli = $this->getMeli();
        $environment = $meli->getEnvironment();

        $params = [
            'client_id'     => $meli->getClientId(),
            'response_type' => 'code',
            'redirect_uri'  => $redirectUri,
            'state'         => Crypt::encrypt(Auth::id())
        ];
        return $environment->getAuthUrl('/authorization') . "?" . http_build_query($params);
    }
}
