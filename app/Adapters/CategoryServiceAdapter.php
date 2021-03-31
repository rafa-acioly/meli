<?php


namespace App\Adapters;


use Dsc\MercadoLivre\Requests\Category\Attribute;
use Dsc\MercadoLivre\Requests\Category\CategoryService;
use Dsc\MercadoLivre\Requests\Category\Predictor;

class CategoryServiceAdapter extends CategoryService
{

    public function findRequiredCategoryAttributes($code)
    {
        return $this->getResponse(
            $this->get("/categories/$code/technical_specs/input"),
            Attribute::class
        );
    }
}
