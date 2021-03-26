<?php


namespace App\Resources\Woocommerce\Entity;


use App\Resources\Enum\ProductType;

class Product extends AbstractEntity
{

    public ProductType $type;

    public ProductDimensions $dimensions;

    /**
     * @var array<ProductImages>
     */
    public array $images = [];

    /**
     * @var array<ProductCategory>
     */
    public array $categories = [];

    public function getStatus(): string
    {
        return $this->status == 'publish' ? 'active' : 'inactive';
    }
}
