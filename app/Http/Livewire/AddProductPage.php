<?php

namespace App\Http\Livewire;

use App\Adapters\MeliAdapter;
use App\Resources\Woocommerce\Entity\Product;
use App\Resources\Woocommerce\Woocommerce;
use Dsc\MercadoLivre\Environments\Site;
use Dsc\MercadoLivre\Requests\Category\CategoryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddProductPage extends Component
{
    public ?string $productSKU = null;
    public $product = null;
    public $suggestedCategory = null;
    private $wooCli;

    public function render()
    {
        return view('products.add-product-page');
    }

    public function mount()
    {
        $this->wooCli = new Woocommerce(Auth::user()->credential);
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
    }

    public function suggestCategory()
    {
        $suggestion = (new CategoryService())->findCategoryPredictor(Site::BRASIL, $this->product['name']);

        $this->suggestedCategory = $suggestion->toArray();
    }
}
