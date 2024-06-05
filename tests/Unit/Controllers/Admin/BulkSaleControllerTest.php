<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use App\Http\Controllers\Admin\BulkSaleController;
use App\Services\BulkSaleService;
use Illuminate\Http\Request;
use Mockery;
use Illuminate\View\View;

class BulkSaleControllerTest extends TestCase
{
    public function testCreateBulkSale()
    {
        // Arrange
        $brands = collect([
            (object)['id' => 1, 'name' => 'Brand 1'],
            (object)['id' => 2, 'name' => 'Brand 2'],
        ]);

        $mockBulkSaleService = Mockery::mock(BulkSaleService::class);
        $mockBulkSaleService->shouldReceive('getAllBrands')
            ->once()
            ->andReturn($brands);

        $controller = new BulkSaleController($mockBulkSaleService);

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.bulk-sale', ['brands' => $brands])
            ->andReturnSelf();

        // Act
        $response = $controller->createBulkSale();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.bulk-sale', $response->getName());
        $this->assertArrayHasKey('brands', $response->getData());
        $this->assertCount(2, $response->getData()['brands']);
    }

    public function testStoreBulkSale()
    {
        // Arrange
        $products = collect([
            (object)['id' => 1, 'name' => 'Product 1'],
            (object)['id' => 2, 'name' => 'Product 2'],
        ]);

        $mockBulkSaleService = Mockery::mock(BulkSaleService::class);
        $mockBulkSaleService->shouldReceive('getProductsByBrandAndCategory')
            ->with(1, 'Elise Robel')
            ->once()
            ->andReturn($products);
        $mockBulkSaleService->shouldReceive('createBulkSale')
            ->with($products, Mockery::any())
            ->once()
            ->andReturnSelf();

        $request = new Request([
            'brand_id' => 1,
            'some_other_data' => 'value'
        ]);

        $controller = new BulkSaleController($mockBulkSaleService);

        // Act
        $response = $controller->storeBulkSale($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('sales.index'), $response->getTargetUrl());
        $this->assertEquals('Products successfully added to sale.', session('success'));
    }

    public function testStoreBulkSaleWithException()
    {
        // Arrange
        $products = collect([
            (object)['id' => 1, 'name' => 'Product 1'],
            (object)['id' => 2, 'name' => 'Product 2'],
        ]);

        $mockBulkSaleService = Mockery::mock(BulkSaleService::class);
        $mockBulkSaleService->shouldReceive('getProductsByBrandAndCategory')
            ->with(1, 'Elise Robel')
            ->once()
            ->andReturn($products);
        $mockBulkSaleService->shouldReceive('createBulkSale')
            ->with($products, Mockery::any())
            ->once()
            ->andThrow(new \Exception('An error occurred'));

        $request = new Request([
            'brand_id' => 1,
            'some_other_data' => 'value'
        ]);

        $controller = new BulkSaleController($mockBulkSaleService);

        // Act
        $response = $controller->storeBulkSale($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals('An error occurred: An error occurred', session('error'));
    }

    public function testShowProductsForBulkSale()
    {
        // Arrange
        $brands = collect([
            (object)['id' => 1, 'name' => 'Brand 1'],
            (object)['id' => 2, 'name' => 'Brand 2'],
        ]);

        $products = collect([
            (object)['id' => 1, 'name' => 'Product 1'],
            (object)['id' => 2, 'name' => 'Product 2'],
        ]);

        $mockBulkSaleService = Mockery::mock(BulkSaleService::class);
        $mockBulkSaleService->shouldReceive('getAllBrands')
            ->once()
            ->andReturn($brands);
        $mockBulkSaleService->shouldReceive('getProductsByBrandAndCategory')
            ->with('1', 'Hair Color')
            ->once()
            ->andReturn($products);

        $request = new Request([
            'brand' => '1'
        ]);

        $controller = new BulkSaleController($mockBulkSaleService);

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.bulk-sale', ['brands' => $brands, 'products' => $products, 'selectedBrand' => '1'])
            ->andReturnSelf();

        // Act
        $response = $controller->showProductsForBulkSale($request);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.bulk-sale', $response->getName());
        $this->assertArrayHasKey('brands', $response->getData());
        $this->assertArrayHasKey('products', $response->getData());
        $this->assertArrayHasKey('selectedBrand', $response->getData());
        $this->assertCount(2, $response->getData()['brands']);
        $this->assertCount(2, $response->getData()['products']);
        $this->assertEquals('1', $response->getData()['selectedBrand']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
