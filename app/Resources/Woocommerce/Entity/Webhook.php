<?php


namespace App\Resources\Woocommerce\Entity;


class Webhook extends AbstractEntity
{
    public int $id;
    public bool $active;
    public string $deliveryURL;
}
