<?php


namespace App\Resources\Connectors;


abstract class Service
{
    abstract public function getEcommerce(): ServiceConnector;

    public function products(): array
    {
        $ecomm = $this->getEcommerce();
        return $ecomm->listProduct();
    }

    public function findProduct(string $sku): array
    {
        $ecomm = $this->getEcommerce();
        return $ecomm->findProduct($sku);
    }
}
