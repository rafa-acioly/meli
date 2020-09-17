<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testGetAllProducts()
    {
        Sanctum::actingAs(
            User::factory()->has(Product::factory())->create()
        );

        $response = $this->get('/api/products');

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function testGetAllProductsReturnEmptyData()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->get('/api/products');

        $response->assertOk()->assertJsonCount(0, 'data');
    }

    public function testCannotGetProductsForUnauthenticatedUser() {

        $response = $this->json('GET', '/api/products');

        $response->assertStatus(401)
            ->assertExactJson([
            'message' => 'Unauthenticated.'
        ]);
    }
}
