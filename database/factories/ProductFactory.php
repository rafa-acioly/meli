<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'id_on_store' => $this->faker->numberBetween(10, 100),
            'buying_mode' => 'free',
            'sku' => Str::random(5),
            'meli_sku' => Str::random(5),
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 100, 200),
            'image_url' => $this->faker->imageUrl(260, 260)
        ];
    }
}
