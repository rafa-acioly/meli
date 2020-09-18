<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Faker\Provider\de_DE\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

//    public function testGetAllProducts()
//    {
//        Sanctum::actingAs(User::factory()->hasProducts(3)->create());
//        $response = $this->get('/api/products');
//
//        $response->assertOk()->assertJsonCount(3, 'data');
//    }
//
//    public function testGetAllProductsReturnEmptyData()
//    {
//        Sanctum::actingAs(User::factory()->create());
//        $response = $this->get('/api/products');
//
//        $response->assertOk()->assertJsonCount(0, 'data');
//    }
//
//    public function testCanFindProductBySku()
//    {
//        $sanc = Sanctum::actingAs(User::factory()->hasProducts(1)->create());
//        $product = $sanc->products()->first();
//
//        $response = $this->get('/api/products/'.$product->woo_product_sku);
//
//        $response->assertOk();
//    }
//
//    public function testCannotGetProductsForUnauthenticatedUser()
//    {
//        $response = $this->json('GET', '/api/products');
//
//        $response->assertUnauthorized()
//            ->assertExactJson(['message' => 'Unauthenticated.']);
//    }
}
