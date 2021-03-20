<?php

namespace App\Http\Livewire;

use App\Adapters\MeliAuthorizationServiceAdapter;
use App\Adapters\MeliEnvironmentAdapter;
use Dsc\MercadoLivre\Meli;
use Livewire\Component;

class MercadolivreIntegrationForm extends Component
{
    private Meli $meli;
    private MeliAuthorizationServiceAdapter $service;

    public function __construct($id = null)
    {
        $this->meli = new Meli(env('MELI_ID'), env('MELI_SECRET'), new MeliEnvironmentAdapter());
        $this->service = new MeliAuthorizationServiceAdapter($this->meli);

        parent::__construct($id);
    }

    public function render()
    {
        return view('livewire.mercadolivre-integration-form', [
            'url' => $this->service->getOAuthUrl(env('MELI_CALLBACK'))
        ]);
    }
}
