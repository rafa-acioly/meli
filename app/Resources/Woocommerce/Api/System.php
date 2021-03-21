<?php


namespace App\Resources\Woocommerce\Api;


class System extends AbstractApi
{
    const ENDPOINT = 'system_status';

    public function ping(): bool
    {
        $system = $this->client->get(self::ENDPOINT);

        return $system != null;
    }
}
