<?php


namespace App\Resources;


use App\Models\Credential;
use App\Resources\Connectors\Service;

class ServiceFactory
{
    public static function get(Credential $credential): Service
    {
        return new Woocommerce($credential);
    }
}
