<?php

namespace App\Http\Livewire;

use App\Resources\Woocommerce\Entity\Product;
use App\Resources\Woocommerce\Woocommerce;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddProductPage extends Component
{
    public ?string $productSKU = null;
    public $product = null;

    /**
     * @var Woocommerce|mixed
     */
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
        $this->product = (array)$product;
    }
}