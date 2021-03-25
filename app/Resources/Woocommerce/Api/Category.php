<?php


namespace App\Resources\Woocommerce\Api;

use App\Resources\Woocommerce\Entity\Category as CategoryEntity;
use Illuminate\Support\Collection;

class Category extends AbstractApi
{
    const ENDPOINT = 'products/categories/';

    /**
     * @return Collection<CategoryEntity>
     */
    public function list(): Collection
    {
        $categories = $this->client->get(self::ENDPOINT);

        throw_if(
            $this->client->http->getResponse()->getCode() != 200,
            new \Exception($this->client->http->getResponse()->getBody())
        );

        return collect($categories)->map(fn($category) => new CategoryEntity($category));
    }

    public function find(int $id): CategoryEntity
    {
        $category = $this->client->get(self::ENDPOINT . "/$id");\

        throw_unless(
            $this->client->http->getResponse()->getCode() == 200,
            $this->client->http->getResponse()->getBody()
        );

        return new CategoryEntity($category);
    }
}
