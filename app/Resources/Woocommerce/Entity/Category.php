<?php


namespace App\Resources\Woocommerce\Entity;

use \App\Models\ProductCategory;


class Category extends AbstractEntity implements ModelConverter
{
    public int $id;
    public string $name;
    public int $parent;

    public function toModel(): ProductCategory
    {
        return new ProductCategory([
            'id_on_store' => $this->id,
            'name' => $this->name
        ]);
    }
}
