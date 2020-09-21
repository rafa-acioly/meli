<?php


namespace App\Resources;


use App\Models\Credential;
use App\Resources\Connectors\Service;
use App\Resources\Connectors\ServiceConnector;
use App\Resources\Connectors\WoocommerceConnector;

class Woocommerce extends Service
{
    const SIGNATURE_HEADER_KEY = 'x-wc-webhook-signature';

    // event name, e.g: updated, created
    const EVENT_KEY = 'x-wc-webhook-event';

    // event type, e.g: product, order
    const EVENT_TYPE_KEY = 'x-wc-webhook-resource';

    private $credential;

    public function __construct(Credential $credential)
    {
        $this->credential = $credential;
    }

    public function getEcommerce(): ServiceConnector
    {
        return new WoocommerceConnector($this->credential);
    }
}
