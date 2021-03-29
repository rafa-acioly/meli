<?php

namespace App\Http\Livewire;

use Dsc\MercadoLivre\Environments\Site;
use Dsc\MercadoLivre\Requests\Category\CategoryService;
use Livewire\Component;

class EditCategory extends Component
{
    /**
     * @var mixed
     */
    public $meliCategories;

    public $firstLevel = null;

    public function render()
    {
        return view('settings.categories.edit-category');
    }

    public function mount(CategoryService $service)
    {
        $this->meliCategories = $service->findCategories(Site::BRASIL)->toArray();
    }
}
