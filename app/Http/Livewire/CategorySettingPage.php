<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CategorySettingPage extends Component
{
    public function render()
    {
        return view('settings.categories.index', [
            'categories' => Auth::user()->productCategories()->paginate(10)
        ]);
    }
}
