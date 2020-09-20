<?php


namespace App\Entities;

use Illuminate\Support\Arr;

/**
 * WoocommerceProduct is a representation of a woocommerce product payload.
 * @package App\Entities
 */
class WoocommerceProduct extends AbstractEntity implements ProductEntity
{
    /**
     * @var int Unique identifier for a product on the client store
     */
    public int $id;

    /**
     * @var string Product name
     */
    public string $name;

    /**
     * @var string Product status
     */
    public string $status;

    /**
     * @var float Product price
     */
    public float $price;

    /**
     * @var string Product type
     */
    public string $type;

    /**
     * @var string Product short description (may contain html tags)
     */
    public string $shortDescription;

    /**
     * @var string Product full description (may contain html tags)
     */
    public string $description;

    /**
     * @var array Product images, list of URL strings.
     * e.g: [http://image.com/cat.jpg, http://image.com/dog.png]
     */
    public array $images;

    /**
     * @var bool Flag to identify if the product has infinite stock or not,
     * of false the stock is "infinity"
     */
    public bool $manageStock;

    /**
     * @var string name definition for stock,
     * e.g: "instock", "outofstock"
     */
    public string $stockStatus;

    /**
     * @var float Stock quantity
     */
    public float $stockQuantity;

    /**
     * @var string Product weight (including package)
     */
    public string $weight;

    /**
     * @var object Product dimension contains all dimensions of a product,
     * e.g: "$dimension->height", "$dimension->width" and "$dimension->length".
     */
    public object $dimensions;

    /**
     * @var array Product categories is a array objects.
     * each object contains "id" and "name".
     */
    public array $categories;

    public function getTitle(): string
    {
        return $this->name;
    }

    public function getCategoryID(): string
    {
        // TODO: Implement getCategoryID() method.
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getInitialQuantity(): int
    {
        return $this->stockQuantity;
    }

    public function getAvailableQuantity(): int
    {
        return $this->stockQuantity;
    }

    public function getThumbnail(): string
    {
        return Arr::first($this->images);
    }

    public function getPictures(): array
    {
        return array_map(function($imageURL) {
            return ['source' => $imageURL];
        }, $this->images);
    }

    public function getListingTypeID(): string
    {
        return "free";
    }
}
