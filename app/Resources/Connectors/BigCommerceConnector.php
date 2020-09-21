<?php


namespace App\Resources\Connectors;


use App\Models\Credential;

class BigCommerceConnector implements ServiceConnector
{
    private $credential;

    public function __construct(Credential $credential)
    {
        $this->credential = $credential;
    }

    public function listProduct(): array
    {
        // TODO: Implement listProduct() method.
    }

    public function findProduct(string $sku): array
    {
        // TODO: Implement findProduct() method.
    }

    public function createOrder(): void
    {
        // TODO: Implement createOrder() method.
    }

    public function updateOrderStatus(): void
    {
        // TODO: Implement updateOrderStatus() method.
    }
}
