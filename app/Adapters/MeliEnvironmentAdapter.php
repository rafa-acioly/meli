<?php

namespace App\Adapters;

use Dsc\MercadoLivre\Configuration;
use Dsc\MercadoLivre\Environments\Production;
use Dsc\MercadoLivre\Environments\Site;

class MeliEnvironmentAdapter extends Production
{
    public function __construct(int $userID, $siteId = Site::BRASIL)
    {
        parent::__construct($siteId, new Configuration(null, new MeliStorageAdapter($userID)));
    }
}
