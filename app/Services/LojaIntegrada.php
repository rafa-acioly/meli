<?php


namespace App\Services;


use App\Models\Credential;
use App\Services\Connectors\LojaIntegradaConnector;
use App\Services\Connectors\Service;
use App\Services\Connectors\ServiceConnector;

class LojaIntegrada extends Service
{
    private $credential;

    public function __construct(Credential $credential)
    {
        $this->credential = $credential;
    }

    public function getEcommerce(): ServiceConnector
    {
        return new LojaIntegradaConnector($this->credential);
    }
}
