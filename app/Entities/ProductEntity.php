<?php


namespace App\Entities;


interface ProductEntity
{
    public function getTitle(): string;
    public function getCategoryID(): string;
    public function getPrice(): float;
    public function getInitialQuantity(): int;
    public function getAvailableQuantity(): int;
    public function getThumbnail(): string;
    public function getPictures(): array;
    public function getListingTypeID(): string;
}
