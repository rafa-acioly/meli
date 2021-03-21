<?php


namespace App\Resources\Woocommerce\Entity;


use App\Resources\Enum\ProductType;

class Product extends AbstractEntity
{
    public int $id;
    public string $sku;
    public string $name;
    public string $dateCreated;
    public string $status;
    public string $catalogVisibility;
    public string $price;
    public string $regularPrice;
    public bool $onSale;
    public bool $virtual;
    public bool $purchasable;
    public string $stockStatus;
    public string $weight;

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
}
