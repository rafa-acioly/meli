<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductList extends Component
{
    /**
     * @var mixed
     */
    public $products;

    public function render()
    {
        return view('products.list');
    }

    public function mount()
    {
        $this->products = Auth::user()->products;
    }
}
