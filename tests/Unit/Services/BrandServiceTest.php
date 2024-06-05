<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\BrandService;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class BrandServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $brandService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->brandService = new BrandService();
    }

    public function testGetAllBrands()
    {
        // Arrange
        Brand::factory()->count(3)->create();

        // Act
        $brands = $this->brandService->getAllBrands();

        // Assert
        $this->assertCount(3, $brands);
    }

    public function testCreateBrand()
    {
        // Arrange
        $data = ['name' => 'Test Brand'];

        // Act
        $brand = $this->brandService->createBrand($data);

        // Assert
        $this->assertDatabaseHas('brands', ['name' => 'Test Brand']);
        $this->assertEquals('Test Brand', $brand->name);
    }

    public function testUpdateBrand()
    {
        // Arrange
        $brand = Brand::factory()->create(['name' => 'Old Name']);
        $data = ['name' => 'New Name'];

        // Act
        $updatedBrand = $this->brandService->updateBrand($brand, $data);

        // Assert
        $this->assertTrue($updatedBrand->wasChanged());
        $this->assertEquals('New Name', $updatedBrand->name);
    }

    public function testDeleteBrand()
    {
        // Arrange
        $brand = Brand::factory()->create();

        // Act
        $this->brandService->deleteBrand($brand);

        // Assert
        $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
    }

    public function testGetBrandByName()
    {
        // Arrange
        $brand = Brand::factory()->create(['name' => 'Test Brand']);

        // Act
        $brandId = $this->brandService->getBrandByName('Test Brand');

        // Assert
        $this->assertEquals($brand->id, $brandId);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
