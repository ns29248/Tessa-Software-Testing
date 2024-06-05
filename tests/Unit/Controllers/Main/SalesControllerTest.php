<?php

namespace Controllers\Main;

use App\Http\Controllers\Main\SalesController;
use App\Services\ProductService;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class SalesControllerTest extends TestCase
{
    public function testIndex()
    {
        // Arrange
        $sales = collect([
            (object)['id' => 1, 'name' => 'Product 1', 'sale_price' => 100],
            (object)['id' => 2, 'name' => 'Product 2', 'sale_price' => 200],
        ]);

        $mockProductService = Mockery::mock(ProductService::class);
        $mockProductService->shouldReceive('getProductsOnSale')
            ->once()
            ->andReturn($sales);

        $controller = new SalesController($mockProductService);

        // Act
        $response = $controller->index();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('main.sales.index', $response->getName());
        $this->assertArrayHasKey('sales', $response->getData());
        $this->assertCount(2, $response->getData()['sales']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
