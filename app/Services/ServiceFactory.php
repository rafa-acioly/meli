<?php


namespace App\Services;


use App\Models\Credential;
use App\Services\Connectors\Service;

class ServiceFactory
{
    public static function get(Credential $credential): Service
    {
        return new Woocommerce($credential);
    }
}
