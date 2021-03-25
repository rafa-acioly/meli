<?php


namespace App\Resources\Woocommerce\Api;


use App\Resources\Woocommerce\Entity\Attribute as AttributeEntity;
use Illuminate\Support\Collection;

class Attribute extends AbstractApi
{
    const ENDPOINT = 'products/attributes';

    /**
     * @return Collection<AttributeEntity>
     * @throws \Throwable
     */
    public function list(): Collection
    {
        $attributes = $this->client->get(self::ENDPOINT);

        throw_if(
            $this->client->http->getResponse()->getCode() != 200,
            new \Exception($this->client->http->getResponse()->getBody())
        );

        return collect($attributes)->map(fn($attr) => new AttributeEntity($attr));
    }

    public function find(int $id): AttributeEntity
    {
        $attribute = $this->client->get(self::ENDPOINT . "/$id");

        return new AttributeEntity($attribute);
    }
}
