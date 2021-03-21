<?php

namespace App\Http\Livewire;

use App\Models\Credential;
use App\Resources\Woocommerce\Woocommerce;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class WoocommerceIntegrationForm extends Component
{
    public ?string $store_url = null;
    public string $url = "";

    protected array $rules = [
        'store_url' => 'required|active_url',
    ];

    public function render()
    {
        return view('livewire.woocommerce-integration-form');
    }

    public function mount()
    {
        $this->store_url = auth()->user()->credential ? auth()->user()->credential->store_url : null;
    }

    public function save()
    {
        $this->validate();
        auth()->user()->credential()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['store_url' => $this->store_url]
        );
        Woocommerce::authorization($this->store_url);
    }
}
