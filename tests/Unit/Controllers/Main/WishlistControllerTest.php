<?php

namespace Controllers\Main;

use App\Http\Controllers\Main\WishlistController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class WishlistControllerTest extends TestCase
{
    public function testShowWishlist()
    {
        // Arrange
        $wishlistedProducts = collect([
            (object)['id' => 1, 'name' => 'Product 1'],
            (object)['id' => 2, 'name' => 'Product 2'],
        ]);

        $user = Mockery::mock(User::class);
        $user->shouldReceive('products')
            ->once()
            ->andReturnSelf();
        $user->shouldReceive('get')
            ->once()
            ->andReturn($wishlistedProducts);

        Auth::shouldReceive('user')
            ->once()
            ->andReturn($user);

        $controller = new WishlistController();

        // Act
        $response = $controller->showWishlist();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('main.wishlist.show-wishlist', $response->getName());
        $this->assertArrayHasKey('wishlistedProducts', $response->getData());
        $this->assertCount(2, $response->getData()['wishlistedProducts']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
