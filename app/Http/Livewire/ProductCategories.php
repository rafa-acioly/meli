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
    protected $meliClient;

    public $categories = [];
    public bool $confirmFullSync = false;
    public bool $syncAllConfirmed = false;

    public $state = null;

    public array $meliCategories = [];

    /**
     * @var CategoryService|mixed
     */
    protected $service = null;

    public function __construct($id = null)
    {
        $cli = new MeliAdapter(env('MELI_ID'), env('MELI_SECRET'));
        $this->service = new CategoryService($cli);
        parent::__construct($id);
    }

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

    public function edit($category)
    {
        $this->state = $category;
        $this->meliCategories[] = $this->service->findCategories(Site::BRASIL)->toArray();
    }

    public function chooseNextCategorySection(string $categoryCode)
    {
        $this->meliCategories[] = $this->service->findCategory($categoryCode)->getChildrenCategories()->toArray();
    }
}
