<?php

namespace App\Http\Livewire;

use App\Models\Credential;
use Livewire\Component;

class WoocommerceIntegrationForm extends Component
{
    public ?string $store_url = null;
    public ?string $consumer_key = null;
    public ?string $consumer_secret = null;

    protected array $rules = [
        'store_url' => 'required|active_url',
        'consumer_key' => 'required|string',
        'consumer_secret' => 'required|string'
    ];

    public function render()
    {
        return view('livewire.woocommerce-integration-form');
    }

    public function mount()
    {
        $credential = auth()->user()->credential;
        $this->consumer_secret = $credential->consumer_secret;
        $this->consumer_key = $credential->consumer_key;
        $this->store_url = $credential->store_url;
    }

    public function save()
    {
        $this->validate();
        auth()->user()->credential()->createOrUpdate([
            'store_url' => $this->store_url,
            'consumer_key' => $this->consumer_key,
            'consumer_secret' => $this->consumer_secret
        ]);
        $this->emit('saved');
    }
}
