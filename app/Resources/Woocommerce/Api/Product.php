<?php


namespace App\Resources\Woocommerce\Api;


use App\Resources\Woocommerce\Entity\Product as ProductEntity;
use Illuminate\Support\Collection;

class Product extends AbstractApi
{
    const ENDPOINT = 'products';

    public function find(string $sku): ProductEntity
    {
        $product = $this->client->get(self::ENDPOINT, ['sku' => $sku]);
        return new ProductEntity($product ? $product[0] : []);
    }

    /**
     * @param array<string> $skus
     * @return Collection<ProductEntity>
     */
    public function list(array $skus)
    {
        $products = $this->client->get(self::ENDPOINT, ['sku' => $skus]);

        return collect($products)->map(fn($product) => new ProductEntity($product));
    }
}
