<?php


namespace App\Entities;


class WoocommerceOrder
{
    public int $id;

    public string $status;

    public object $billing;

    public object $shipping;
}
