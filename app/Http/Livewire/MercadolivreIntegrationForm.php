<?php

namespace App\Http\Livewire;

use App\Adapters\MeliAuthorizationServiceAdapter;
use App\Adapters\MeliEnvironmentAdapter;
use Dsc\MercadoLivre\Meli;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MercadolivreIntegrationForm extends Component
{
    private Meli $meli;
    private MeliAuthorizationServiceAdapter $service;

    public $code = null;
    public $state = null;

    protected $queryString = [
        'code'  => ['expect' => ''],
        'state' => ['expect' => '']
    ];

    public function __construct($id = null)
    {
        $this->meli = new Meli(env('MELI_ID'), env('MELI_SECRET'), new MeliEnvironmentAdapter());
        $this->service = new MeliAuthorizationServiceAdapter($this->meli);

        parent::__construct($id);
    }

    public function render()
    {

        dd(app()->make('redis'));

        if ($this->code && ($this->state == Auth::id())) {
            $this->service->authorize($this->code, env('MELI_CALLBACK'));
        }
        return view('livewire.mercadolivre-integration-form', [
            'url' => $this->service->getOAuthUrl(env('MELI_CALLBACK'))
        ]);
    }
}
