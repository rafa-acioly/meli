<?php

namespace App\Http\Livewire;

use App\Adapters\MeliAuthorizationServiceAdapter;
use App\Adapters\MeliEnvironmentAdapter;
use App\Adapters\MeliStorageAdapter;
use Dsc\MercadoLivre\AccessToken;
use Dsc\MercadoLivre\Meli;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MercadolivreIntegrationForm extends Component
{
    private Meli $meli;
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
        $this->meli = new Meli(env('MELI_ID'), env('MELI_SECRET'), new MeliEnvironmentAdapter(auth()->id()));
        $this->service = new MeliAuthorizationServiceAdapter($this->meli);
        $this->enabled = (bool)(new MeliStorageAdapter(auth()->id()))->get(AccessToken::TOKEN);

        parent::__construct($id);
    }

    public function render()
    {
        if ($this->code && ($this->state == Auth::id())) {
            return $this->service->authorize($this->code, env('MELI_CALLBACK'));
        }

        return view('livewire.mercadolivre-integration-form', [
            'url' => $this->service->getOAuthUrl(env('MELI_CALLBACK'))
        ]);
    }
}
