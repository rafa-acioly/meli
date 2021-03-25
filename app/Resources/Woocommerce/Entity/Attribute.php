<?php


namespace App\Resources\Woocommerce\Entity;


use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Model;

class Attribute extends AbstractEntity implements ModelConverter
{
    public int $id;
    public string $name;

    public function toModel(): Model
    {
        return new ProductAttribute([
            'id_on_store'   => $this->id,
            'name'          => $this->name
        ]);
    }
}
