<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private function authenticate(): array
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        return [$user, $token];
    }

    public function test_user_can_list_their_products(): void
    {
        [$user, $token] = $this->authenticate();
        Product::factory()->count(3)->create(['user_id' => $user->id]);
        Product::factory()->create();

        $response = $this->withToken($token)->getJson('/api/v1/products');

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonCount(3, 'data');
    }

    public function test_user_can_search_products_by_name(): void
    {
        [$user, $token] = $this->authenticate();
        Product::factory()->create(['user_id' => $user->id, 'name' => 'Laptop Pro']);
        Product::factory()->create(['user_id' => $user->id, 'name' => 'Wireless Mouse']);

        $response = $this->withToken($token)->getJson('/api/v1/products?search=Laptop');

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Laptop Pro');
    }

    public function test_user_can_create_product(): void
    {
        Storage::fake('public');
        [$user, $token] = $this->authenticate();

        $response = $this->withToken($token)->postJson('/api/v1/products', [
            'name' => 'New Product',
            'description' => 'A test product',
            'price' => 99.99,
            'quantity' => 10,
        ]);

        $response->assertCreated()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.name', 'New Product');

        $this->assertDatabaseHas('products', [
            'user_id' => $user->id,
            'name' => 'New Product',
        ]);
    }

    public function test_user_can_update_product(): void
    {
        [$user, $token] = $this->authenticate();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $response = $this->withToken($token)->putJson("/api/v1/products/{$product->id}", [
            'name' => 'Updated Name',
            'price' => 50,
            'quantity' => 5,
        ]);

        $response->assertOk()
            ->assertJsonPath('data.name', 'Updated Name');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_user_can_delete_product(): void
    {
        [$user, $token] = $this->authenticate();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $response = $this->withToken($token)->deleteJson("/api/v1/products/{$product->id}");

        $response->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_user_cannot_access_other_users_product(): void
    {
        [$user, $token] = $this->authenticate();
        $product = Product::factory()->create();

        $this->withToken($token)->getJson("/api/v1/products/{$product->id}")
            ->assertNotFound();
    }

    public function test_product_creation_requires_valid_data(): void
    {
        [, $token] = $this->authenticate();

        $this->withToken($token)->postJson('/api/v1/products', [])
            ->assertUnprocessable()
            ->assertJsonPath('success', false);
    }

    public function test_user_can_upload_product_image(): void
    {
        Storage::fake('public');
        [, $token] = $this->authenticate();

        $response = $this->withToken($token)->post('/api/v1/products', [
            'name' => 'Product with Image',
            'price' => 25,
            'quantity' => 3,
            'image' => UploadedFile::fake()->image('product.jpg'),
        ], ['Accept' => 'application/json']);

        $response->assertCreated();
        Storage::disk('public')->assertExists('products/'.basename($response->json('data.image')));
    }
}
