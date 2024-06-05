<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Mockery;

class BrandControllerTest extends TestCase
{
    public function testIndex()
    {
        // Arrange
        $brands = collect([
            (object)['id' => 1, 'name' => 'Brand 1'],
            (object)['id' => 2, 'name' => 'Brand 2'],
        ]);

        $mockBrandService = Mockery::mock(BrandService::class);
        $mockBrandService->shouldReceive('getAllBrands')
            ->once()
            ->andReturn($brands);

        $controller = new BrandController($mockBrandService);

        // Act
        $response = $controller->index();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.brand', $response->getName());
        $this->assertArrayHasKey('brands', $response->getData());
        $this->assertCount(2, $response->getData()['brands']);
    }

    public function testStore()
    {
        // Arrange
        $validatedData = ['name' => 'New Brand'];

        $mockBrandService = Mockery::mock(BrandService::class);
        $mockBrandService->shouldReceive('createBrand')
            ->with($validatedData)
            ->once()
            ->andReturnSelf();

        $request = Mockery::mock(BrandRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        $controller = new BrandController($mockBrandService);

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('brands.index'), $response->getTargetUrl());
        $this->assertEquals('Brand created successfully', Session::get('success'));
    }

    public function testEdit()
    {
        // Arrange
        $brand = Brand::factory()->make(['id' => 1, 'name' => 'Brand 1']);

        $controller = new BrandController(Mockery::mock(BrandService::class));

        // Act
        $response = $controller->edit($brand);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.edit-brand', $response->getName());
        $this->assertArrayHasKey('brand', $response->getData());
        $this->assertEquals($brand, $response->getData()['brand']);
    }

    public function testUpdate()
    {
        // Arrange
        $brand = Brand::factory()->make(['id' => 1, 'name' => 'Brand 1']);
        $validatedData = ['name' => 'Updated Brand'];

        $mockBrandService = Mockery::mock(BrandService::class);
        $mockBrandService->shouldReceive('updateBrand')
            ->with($brand, $validatedData)
            ->once()
            ->andReturnSelf();

        $request = Mockery::mock(BrandRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        $controller = new BrandController($mockBrandService);

        // Act
        $response = $controller->update($request, $brand);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('brands.index'), $response->getTargetUrl());
        $this->assertEquals('Brand updated successfully', Session::get('success'));
    }

    public function testDestroy()
    {
        // Arrange
        $brand = Brand::factory()->make(['id' => 1, 'name' => 'Brand 1']);

        $mockBrandService = Mockery::mock(BrandService::class);
        $mockBrandService->shouldReceive('deleteBrand')
            ->with($brand)
            ->once()
            ->andReturnSelf();

        $controller = new BrandController($mockBrandService);

        // Act
        $response = $controller->destroy($brand);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('brands.index'), $response->getTargetUrl());
        $this->assertEquals('Brand deleted successfully', Session::get('success'));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
