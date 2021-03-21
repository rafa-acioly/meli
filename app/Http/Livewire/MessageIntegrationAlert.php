<?php

namespace App\Http\Livewire;

use App\Adapters\MeliStorageAdapter;
use Dsc\MercadoLivre\AccessToken;
use Livewire\Component;

class MessageIntegrationAlert extends Component
{
    public function render()
    {
        return view('livewire.message-integration-alert');
    }
}
