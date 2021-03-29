<?php

namespace App\Http\Livewire;

use App\Adapters\MeliAdapter;
use App\Jobs\WoocommerceProductCategoriesSync;
use App\Resources\Woocommerce\Woocommerce;
use Dsc\MercadoLivre\Environments\Site;
use Dsc\MercadoLivre\Requests\Category\CategoryService;
use Dsc\MercadoLivre\Requests\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductCategories extends Component
{

    public $confirmFullSync, $editModal;

    public $categories;

    public $selectedFirstLevel = null;

    public $selectedSecondLevel = null;
    public $secondLevelOptions;

    public $selectedThirdLevel = null;
    public $thirdLevelOptions;

    public function render()
    {
        $categories = (new CategoryService())->findCategories(Site::BRASIL)->toArray();

        return view('settings.categories.list', [
            'categoriesOptions' => collect($categories)
        ]);
    }

    public function mount()
    {
        $this->categories = Auth::user()->productCategories;
        $this->secondLevelOptions = collect();
        $this->thirdLevelOptions = collect();
    }

    public function syncAll()
    {
        $credential = Auth::user()->credential;
        WoocommerceProductCategoriesSync::dispatch(new Woocommerce($credential), Auth::user());

        $this->confirmFullSync = !$this->confirmFullSync;
        notify()->success('Suas categorias serão sincronizadas em breve.', 'Sucesso!');
    }

    public function updatedSelectedFirstLevel($value)
    {
        $categories = (new CategoryService())->findCategory($value)->getChildrenCategories()->toArray();
        $this->secondLevelOptions = collect($categories);
        $this->selectedSecondLevel = null;
    }

    public function updatedSelectedSecondLevel($value)
    {
        $categories = (new CategoryService())->findCategory($value)->getChildrenCategories()->toArray();
        $this->thirdLevelOptions = collect($categories);
        $this->selectedThirdLevel = null;
    }

    public function updatedSelectedThirdLevel($value)
    {
        dd($value);
    }
}
