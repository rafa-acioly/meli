<?php


namespace App\Resources;


use App\Models\Credential;
use App\Resources\Connectors\Service;
use App\Resources\Connectors\ServiceConnector;
use App\Resources\Connectors\MagentoConnector;

class Magento extends Service
{
    private $credential;

    public function __construct(Credential $credential)
    {
        $this->credential = $credential;
    }

    public function getEcommerce(): ServiceConnector
    {
        return new MagentoConnector($this->credential);
    }
}
