<?php


namespace App\Adapters;


use Dsc\MercadoLivre\Environment;
use Dsc\MercadoLivre\Meli;
use Illuminate\Support\Facades\Auth;

class MeliAdapter extends Meli
{

    public function __construct($clientId, $clientSecret)
    {
        parent::__construct($clientId, $clientSecret, new MeliEnvironmentAdapter(Auth::id()));
    }
}
