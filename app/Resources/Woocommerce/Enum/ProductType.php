<?php


namespace App\Resources\Enum;


class ProductType extends \SplEnum
{
    const __default = self::Simple;

    const Simple    = 'simple';
    const Grouped   = 'grouped';
    const Variable  = 'variable';
}
