<?php


namespace App\Resources\Woocommerce\Api;


use App\Resources\Woocommerce\Entity\Product as ProductEntity;

class Product extends AbstractApi
{
    const ENDPOINT = "products";

    public function find(string $sku): ProductEntity
    {
        $product = $this->client->get(sprintf('%s/%s', self::ENDPOINT, $sku));
        $product = json_decode($product);

        return new ProductEntity($product);
    }

    /**
     * @param array<string> $skus
     * @return array<ProductEntity>
     */
    public function list(array $skus): array
    {
        $products = $this->client->get(self::ENDPOINT, $skus);
        $products = json_decode($products);

        return array_map(function($product) {
            return new ProductEntity($product);
        }, $products);
    }
}
