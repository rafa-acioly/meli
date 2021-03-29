<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductPage extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        return view('products.index', [
            'products' => Auth::user()->products()->where('name', 'like', '%'.$this->search.'%')->paginate(15)
        ]);
    }
}
