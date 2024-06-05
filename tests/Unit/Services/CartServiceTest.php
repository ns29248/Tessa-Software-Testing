<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\CartService;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $cartService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cartService = new CartService();
    }

    public function testAddToCart()
    {
        // Arrange
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'address' => '123 Main St',
            'city' => 'Anytown',
            'phone' => '555-555-5555',
            'postcode' => '12345',
            'password' => bcrypt('password'),
            'request_submitted' => false,
        ]);
        $brand = Brand::create(['name' => 'Brand 1']);
        $category = Category::create(['name' => 'Category 1']);

        $product = Product::create([
            'id' => 1,
            'name' => 'Product 1',
            'price' => 100,
            'stylist_price' => 80,
            'quantity' => 3,
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);
        $quantity = 2;

        Auth::shouldReceive('user')->andReturn($user);

        // Act
        $cartItem = $this->cartService->addToCart($user->id, $product->id, $quantity);

        // Assert
        $this->assertInstanceOf(Cart::class, $cartItem);
        $this->assertEquals($user->id, $cartItem->user_id);
        $this->assertEquals($product->id, $cartItem->product_id);
        $this->assertEquals($quantity, $cartItem->quantity);
        $this->assertEquals($product->price, $cartItem->price); // Assuming the user is not a stylist and no sale
    }

    public function testCalculatePrice()
    {
        // Arrange
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'address' => '123 Main St',
            'city' => 'Anytown',
            'phone' => '555-555-5555',
            'postcode' => '12345',
            'password' => bcrypt('password'),
            'request_submitted' => false,
            'role' => 1, // Regular user
        ]);
        $brand = Brand::create(['name' => 'Brand 1']);
        $category = Category::create(['name' => 'Category 1']);

        $product = Product::create([
            'id' => 1,
            'name' => 'Product 1',
            'price' => 100,
            'stylist_price' => 80,
            'quantity' => 3,
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);
        $cartItem = Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        // Act
        $price = $this->cartService->calculatePrice($cartItem);

        // Assert
        $this->assertEquals($product->price, $price);
    }

    public function testCalculatePriceForStylist()
    {
        // Arrange
        $user = User::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'address' => '456 Main St',
            'city' => 'Anytown',
            'phone' => '555-555-5556',
            'postcode' => '12345',
            'password' => bcrypt('password'),
            'request_submitted' => false,
            'role' => 2, // Stylist user
        ]);
        $brand = Brand::create(['name' => 'Brand 1']);
        $category = Category::create(['name' => 'Category 1']);
        $product = Product::create([
            'id' => 1,
            'name' => 'Product 1',
            'price' => 100,
            'stylist_price' => 80,
            'quantity' => 3,
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);
        $cartItem = Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->stylist_price,
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        // Act
        $price = $this->cartService->calculatePrice($cartItem);

        // Assert
        $this->assertEquals($product->stylist_price, $price);
    }

    public function testDeleteCart()
    {
        // Arrange
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'address' => '123 Main St',
            'city' => 'Anytown',
            'phone' => '555-555-5555',
            'postcode' => '12345',
            'password' => bcrypt('password'),
            'request_submitted' => false,
        ]);
        $brand = Brand::create(['name' => 'Brand 1']);
        $category = Category::create(['name' => 'Category 1']);
        $product = Product::create([
            'id' => 1,
            'name' => 'Product 1',
            'price' => 100,
            'stylist_price' => 80,
            'quantity' => 3,
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        // Act
        $this->cartService->deleteCart($user);

        // Assert
        $this->assertDatabaseMissing('carts', ['user_id' => $user->id]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
