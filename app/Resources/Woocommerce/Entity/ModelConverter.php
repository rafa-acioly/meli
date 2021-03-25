<?php


namespace App\Resources\Woocommerce\Entity;

use Illuminate\Database\Eloquent\Model;


interface ModelConverter
{
    public function toModel(): Model;
}
