<?php

namespace Controllers\Main;

use App\Http\Controllers\Main\HairColorController;
use App\Services\ProductService;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class HairColorControllerTest extends TestCase
{
    public function testShowHairColors()
    {
        // Arrange
        $brandName = 'TestBrand';
        $products = collect([
            (object)['id' => 1, 'name' => 'Product 1'],
            (object)['id' => 2, 'name' => 'Product 2'],
            (object)['id' => 3, 'name' => 'Product 3'],
        ]);

        $mockProductService = Mockery::mock(ProductService::class);
        $mockProductService->shouldReceive('showHairColors')
            ->with($brandName)
            ->andReturn($products);

        $controller = new HairColorController($mockProductService);

        // Act
        $response = $controller->showHairColors($brandName);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('main.hair-color.index', $response->getName());
        $this->assertArrayHasKey('products', $response->getData());
        $this->assertCount(3, $response->getData()['products']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
