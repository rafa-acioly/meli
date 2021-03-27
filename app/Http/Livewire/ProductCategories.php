<?php

namespace App\Http\Livewire;

use App\Adapters\MeliAdapter;
use App\Jobs\WoocommerceProductCategoriesSync;
use App\Resources\Woocommerce\Woocommerce;
use Dsc\MercadoLivre\Environments\Site;
use Dsc\MercadoLivre\Requests\Category\CategoryService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductCategories extends Component
{
    private $meliClient;

    public $categories = [];
    public bool $confirmFullSync = false;
    public bool $syncAllConfirmed = false;

    public array $meliFirstLevelCategory = [];

    public function mount()
    {
        $this->categories = Auth::user()->productCategories;
        $this->meliClient = new CategoryService();
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

    public function edit($category)
    {
        $categories = $this->meliClient->findCategories(Site::BRASIL);
        dd($categories);
    }
}
