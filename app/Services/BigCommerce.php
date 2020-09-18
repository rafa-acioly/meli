<?php


namespace App\Services;


use App\Models\Credential;
use App\Services\Connectors\BigCommerceConnector;
use App\Services\Connectors\Service;
use App\Services\Connectors\ServiceConnector;

class BigCommerce extends Service
{
    private $credential;

    public function __construct(Credential $credential)
    {
        $this->credential = $credential;
    }

    public function getEcommerce(): ServiceConnector
    {
        return new BigCommerceConnector($this->credential);
    }
}
