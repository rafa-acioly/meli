<?php

namespace App\Http\Livewire;

use App\Adapters\MeliAdapter;
use App\Adapters\MeliAuthorizationServiceAdapter;
use App\Adapters\MeliStorageAdapter;
use Dsc\MercadoLivre\AccessToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class MercadolivreIntegrationForm extends Component
{
    private MeliAuthorizationServiceAdapter $service;

    public $code = null;
    public $state = null;
    public bool $enabled = false;

    protected $queryString = [
        'code'  => ['expect' => ''],
        'state' => ['expect' => '']
    ];

    public function __construct($id = null)
    {
        $this->service = new MeliAuthorizationServiceAdapter(
            new MeliAdapter(env('MELI_ID'), env('MELI_SECRET'))
        );
        $this->enabled = (bool)(new MeliStorageAdapter(auth()->id()))->get(AccessToken::TOKEN);

        parent::__construct($id);
    }

    public function render()
    {
        if ($this->code && (Crypt::decrypt($this->state) == Auth::id())) {
            $this->service->authorize($this->code, env('MELI_CALLBACK'));
        }

        return view('livewire.mercadolivre-integration-form', [
            'url' => $this->service->getOAuthUrl(env('MELI_CALLBACK'))
        ]);
    }
}
