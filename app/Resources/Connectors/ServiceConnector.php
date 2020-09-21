<?php


namespace App\Resources\Connectors;


use App\Models\Credential;

interface ServiceConnector
{
    public function listProduct(): array;
    public function findProduct(string $sku): array;
    public function createOrder(): void;
    public function updateOrderStatus(): void;
}
