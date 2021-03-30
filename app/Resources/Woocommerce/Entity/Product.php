<?php


namespace App\Resources\Woocommerce\Entity;


use App\Resources\Enum\ProductType;
use Illuminate\Support\Collection;

class Product extends AbstractEntity
{
    public string $name;

    public string $type;

    /**
     * @var Collection<ProductDimensions>
     */
    public $dimensions;

    /**
     * @var Collection<ProductImage>
     */
    public $images;

    /**
     * @var array<ProductCategory>
     */
    public array $categories = [];

    public function getStatus(): string
    {
        return $this->status == 'publish' ? 'active' : 'inactive';
    }

    public function setDimensions($dimensions)
    {
        $this->dimensions = new ProductDimensions($dimensions);
    }

    public function setImages(array $images)
    {
        $this->images = collect($images)->map(fn($image) => new ProductImage($image));
    }
}
