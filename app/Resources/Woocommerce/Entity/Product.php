<?php


namespace App\Resources\Woocommerce\Entity;


use Illuminate\Support\Collection;

class Product extends AbstractEntity
{
    public string $sku;

    public string $name;

    public $price;

    public  $regularPrice;

    public $salePrice;

    public string $type;

    public string $description;

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
    public $categories = [];

    public function exist(): bool
    {
        return !empty($this->sku);
    }

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
        $this->images = collect($images)->map(fn($image) => (array)(new ProductImage($image)));
    }

    public function setCategories(array $categories)
    {
        $this->categories = collect($categories)->map(fn($category) => (array)(new ProductCategory($category)));
    }

    public function setRegularPrice($price)
    {
        $this->regularPrice = $price;
    }

    public function setSalePrice($price)
    {
        $this->salePrice = $price;
    }
}
