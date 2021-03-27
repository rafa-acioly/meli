<?php

namespace App\Http\Livewire;

use App\Jobs\WoocommerceProductCategoriesSync;
use App\Resources\Woocommerce\Woocommerce;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductCategories extends Component
{
    public $categories = [];
    public bool $confirmFullSync = false;
    public bool $syncAllConfirmed = false;

    public function mount()
    {
        $this->categories = Auth::user()->productCategories;
    }

    public function render()
    {
        return view('settings.categories.list');
    }

    public function syncAll()
    {
        $credential = Auth::user()->credential;
        WoocommerceProductCategoriesSync::dispatch(new Woocommerce($credential), Auth::user());

        $this->confirmFullSync = !$this->confirmFullSync;
        notify()->success('Suas categorias serão sincronizadas em breve.', 'Sucesso!');
    }
}
