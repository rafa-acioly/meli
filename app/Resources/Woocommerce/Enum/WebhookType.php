<?php

namespace App\Resources\Woocommerce\Enum;


class WebhookType extends \SplEnum
{
    const Product   = 'product.updated';
    const Order     = 'order.updated';
}
