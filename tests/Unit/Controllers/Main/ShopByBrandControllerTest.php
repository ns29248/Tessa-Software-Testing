<?php

namespace Controllers\Main;

use App\Http\Controllers\Main\ShopByBrandController;
use App\Services\BrandService;
use Mockery;
use Tests\TestCase;

class ShopByBrandControllerTest extends TestCase
{
    public function testShopByBrand()
    {
        // Arrange
        $brandName = 'TestBrand';
        $brandId = 1;

        $mockBrandService = Mockery::mock(BrandService::class);
        $mockBrandService->shouldReceive('getBrandByName')
            ->with($brandName)
            ->once()
            ->andReturn($brandId);

        $controller = new ShopByBrandController($mockBrandService);

        // Act
        $response = $controller->shopByBrand($brandName);

        // Assert
        $this->assertEquals(session('brandId'), $brandId);
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url('/shop'), $response->getTargetUrl());
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
