<?php

namespace App\Http\Livewire;

use Dsc\MercadoLivre\Environments\Site;
use Dsc\MercadoLivre\Requests\Category\CategoryService;
use Dsc\MercadoLivre\Requests\Service;
use Livewire\Component;

class CategoryEditModal extends Component
{
    public $category;

    public $selectedFirstLevel;

    public $selectedSecondLevel;
    protected $secondLevelOptions;

    public $selectedThirdLevel;
    protected $thirdLevelOptions;

    public $listeners = ['editCategory'];

    public function render()
    {
        return view('settings.categories.edit-category', [
            'categoriesOptions' => (new CategoryService())->findCategories(Site::BRASIL)->toArray(),
            'secondLevelOptions' => $this->secondLevelOptions,
            'thirdLevelOptions' => $this->thirdLevelOptions
        ]);
    }

    public function editCategory($category)
    {
        $this->category = $category;
    }

    public function updatedSelectedFirstlevel($categoryID)
    {
        $this->secondLevelOptions = (new CategoryService())->findCategory($categoryID)->getChildrenCategories()->toArray();
    }

    public function updatedSelectedSecondLevel($categoryID)
    {
        $cat = (new CategoryService())->findCategory($categoryID)->getChildrenCategories()->toArray();
        dd($cat);
        $this->thirdLevelOptions = (new CategoryService())->findCategory($categoryID)->getChildrenCategories()->toArray();
    }
}
