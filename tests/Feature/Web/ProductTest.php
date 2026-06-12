<?php

namespace Tests\Feature\Web;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_products(): void
    {
        $this->get('/products')->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_products(): void
    {
        $user = User::factory()->create();
        Product::factory()->create(['user_id' => $user->id, 'name' => 'Test Product']);

        $this->actingAs($user)
            ->get('/products')
            ->assertOk()
            ->assertSee('Test Product');
    }

    public function test_user_can_search_products(): void
    {
        $user = User::factory()->create();
        Product::factory()->create(['user_id' => $user->id, 'name' => 'Unique Gadget']);
        Product::factory()->create(['user_id' => $user->id, 'name' => 'Other Item']);

        $this->actingAs($user)
            ->get('/products?search=Unique')
            ->assertOk()
            ->assertSee('Unique Gadget')
            ->assertDontSee('Other Item');
    }

    public function test_user_can_create_product(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/products', [
                'name' => 'Created Product',
                'description' => 'Description',
                'price' => 19.99,
                'quantity' => 5,
            ])
            ->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'user_id' => $user->id,
            'name' => 'Created Product',
        ]);
    }

    public function test_user_can_delete_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->delete("/products/{$product->id}")
            ->assertRedirect('/products');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
