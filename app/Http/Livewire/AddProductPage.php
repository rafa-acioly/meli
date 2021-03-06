<?php

namespace App\Http\Livewire;

use App\Adapters\CategoryServiceAdapter;
use App\Resources\Woocommerce\Woocommerce;
use Dsc\MercadoLivre\Environments\Site;
use Dsc\MercadoLivre\Requests\Category\CategoryService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddProductPage extends Component
{
    public ?string $productSKU = null;

    /**
     * Product is the ProductEntity instance of a woocommerce product
     * @var \App\Resources\Woocommerce\Entity\Product
     */
    protected $product = null;

    /**
     * SuggestedCategory is a instance of Predictor
     * @var \Dsc\MercadoLivre\Requests\Category\Predictor
     */
    protected $suggestedCategory = null;

    /**
     * categoryID is the category ID from Mercado livre category
     * @var string
     */
    public $categoryID = null;

    private $wooCli;

    public function render()
    {
        return view('products.add-product-page', [
            'product' => $this->product,
            'suggestedCategory' => $this->suggestedCategory
        ]);
    }

    public function updatedProductSKU(string $sku)
    {
        $wooCli = new Woocommerce(Auth::user()->credential);
        $product = $wooCli->product()->find($sku);

        if (!$product->exist()) {
            return $this->addError('productSKU', 'SKU não encontrado');
        }

        $this->resetValidation(['productSKU']);
        $this->product = (array)$product;
        $this->suggestCategory();
    }

    public function updatedCategoryID($categoryID)
    {
        $category = (new CategoryServiceAdapter())->findCategoryAttributes($categoryID);
        dd($category);
    }

    public function suggestCategory()
    {
        $suggestion = (new CategoryService())->findCategoryPredictor(Site::BRASIL, $this->product['name']);

        $this->suggestedCategory = $suggestion->toArray();
    }
}
