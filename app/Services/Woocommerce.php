<?php


namespace App\Services;


use App\Models\Credential;
use App\Services\Connectors\Service;
use App\Services\Connectors\ServiceConnector;
use App\Services\Connectors\WoocommerceConnector;

class Woocommerce extends Service
{
    private $credential;

    public function __construct(Credential $credential)
    {
        $this->credential = $credential;
    }

    public function getEcommerce(): ServiceConnector
    {
        return new WoocommerceConnector($this->credential);
    }
}
