<?php

namespace Controllers\Main;

use App\Http\Controllers\Main\MainController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class MainControllerTest extends TestCase
{
    public function testShowProducts()
    {
        // Arrange
        $latestProducts = collect([
            (object)['id' => 1, 'name' => 'Latest Product 1'],
            (object)['id' => 2, 'name' => 'Latest Product 2'],
        ]);

        $popularProducts = collect([
            (object)['id' => 3, 'name' => 'Popular Product 1'],
            (object)['id' => 4, 'name' => 'Popular Product 2'],
            (object)['id' => 5, 'name' => 'Popular Product 3'],
        ]);

        $mockProductService = Mockery::mock(ProductService::class);
        $mockProductService->shouldReceive('latestProducts')
            ->once()
            ->andReturn($latestProducts);

        $mockProductService->shouldReceive('getProducts')
            ->once()
            ->andReturnSelf();
        $mockProductService->shouldReceive('inRandomOrder')
            ->once()
            ->andReturnSelf();
        $mockProductService->shouldReceive('paginate')
            ->with(3)
            ->once()
            ->andReturn($popularProducts);

        $controller = new MainController($mockProductService);

        // Act
        $response = $controller->showProducts(new Request());

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('main.home.index', $response->getName());
        $this->assertArrayHasKey('products', $response->getData());
        $this->assertArrayHasKey('popularProducts', $response->getData());
        $this->assertCount(2, $response->getData()['products']);
        $this->assertCount(3, $response->getData()['popularProducts']);
    }

    public function testShop()
    {
        // Arrange
        $controller = new MainController(Mockery::mock(ProductService::class));

        // Act
        $response = $controller->shop();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('main.shop.shop', $response->getName());
    }

    public function testShow()
    {
        // Arrange
        $brand = Brand::factory()->create();
        $category = Category::factory()->create();

        $product = Product::factory()->make([
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);

        $relatedProducts = collect([
            (object)['id' => 2, 'name' => 'Related Product 1'],
            (object)['id' => 3, 'name' => 'Related Product 2'],
        ]);

        $mockProductService = Mockery::mock(ProductService::class);
        $mockProductService->shouldReceive('show')
            ->with($product)
            ->once()
            ->andReturn($relatedProducts);

        $controller = new MainController($mockProductService);

        // Act
        $response = $controller->show($product);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('main.show-product', $response->getName());
        $this->assertArrayHasKey('product', $response->getData());
        $this->assertArrayHasKey('relatedProducts', $response->getData());
        $this->assertEquals($product, $response->getData()['product']);
        $this->assertCount(2, $response->getData()['relatedProducts']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
