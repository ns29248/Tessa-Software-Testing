<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\BulkSaleService;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BulkSaleServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $bulkSaleService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bulkSaleService = new BulkSaleService();
    }

    public function testGetAllBrands()
    {
        // Arrange
        Brand::query()->delete();
        $brand1 = new Brand(['id' => 1, 'name' => 'Brand 1']);
        $brand2 = new Brand(['id' => 2, 'name' => 'Brand 2']);
        $brand1->save();
        $brand2->save();

        // Act
        $result = $this->bulkSaleService->getAllBrands();

        // Assert
        $this->assertCount(2, $result);
        $this->assertEquals('Brand 1', $result->first()->name);
    }

    public function testGetProductsByBrandAndCategory()
    {
        // Arrange
        $brand = new Brand(['id' => 1, 'name' => 'Brand 1']);
        $brand->save();
        $category = new Category(['id' => 1, 'name' => 'Category 1']);
        $category->save();
        $product1 = new Product([
            'id' => 1,
            'name' => 'Product 1',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'quantity' => 10,
            'price' => 100,
            'stylist_price' => 80
        ]);
        $product2 = new Product([
            'id' => 2,
            'name' => 'Product 2',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'quantity' => 10,
            'price' => 100,
            'stylist_price' => 80
        ]);
        $product1->save();
        $product2->save();

        // Act
        $result = $this->bulkSaleService->getProductsByBrandAndCategory($brand->id, $category->name);

        // Assert
        $this->assertCount(2, $result);
        $this->assertEquals('Product 1', $result->first()->name);
    }

    public function testCreateBulkSale()
    {
        // Arrange
        $brand = new Brand(['id' => 1, 'name' => 'Brand 1']);
        $brand->save();
        $category = new Category(['id' => 1, 'name' => 'Category 1']);
        $category->save();
        $product1 = new Product([
            'id' => 1,
            'name' => 'Product 1',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'quantity' => 10,
            'price' => 100,
            'stylist_price' => 80
        ]);
        $product2 = new Product([
            'id' => 2,
            'name' => 'Product 2',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'quantity' => 10,
            'price' => 100,
            'stylist_price' => 80
        ]);
        $product1->save();
        $product2->save();

        $saleDetails = [
            'sale_price' => 50,
            'start_date' => '2024-06-01',
            'end_date' => '2024-06-30',
        ];

        // Mock the DB transaction methods
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();
        DB::shouldReceive('rollBack')->never();

        // Mock the Sale upsert method
        Mockery::mock('alias:App\Models\Sale')
            ->shouldReceive('upsert')
            ->with(Mockery::on(function ($salesData) use ($product1, $product2, $saleDetails) {
                return count($salesData) === 2 &&
                    $salesData[0]['product_id'] === $product1->id &&
                    $salesData[1]['product_id'] === $product2->id &&
                    $salesData[0]['sale_price'] === $saleDetails['sale_price'] &&
                    $salesData[0]['start_date'] === $saleDetails['start_date'] &&
                    $salesData[0]['end_date'] === $saleDetails['end_date'];
            }), ['product_id'], ['sale_price', 'start_date', 'end_date', 'updated_at'])
            ->once();

        // Act
        $result = $this->bulkSaleService->createBulkSale(collect([$product1, $product2]), $saleDetails);

        // Assert
        $this->assertTrue($result);
    }

    public function testCreateBulkSaleThrowsException()
    {
        // Arrange
        $brand = new Brand(['id' => 1, 'name' => 'Brand 1']);
        $brand->save();
        $category = new Category(['id' => 1, 'name' => 'Category 1']);
        $category->save();
        $product = new Product([
            'id' => 1,
            'name' => 'Product 1',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'quantity' => 10,
            'price' => 100,
            'stylist_price' => 80
        ]);
        $product->save();

        $saleDetails = [
            'sale_price' => 50,
            'start_date' => '2024-06-01',
            'end_date' => '2024-06-30',
        ];

        // Mock the DB transaction methods
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('rollBack')->once();

        // Mock the Sale upsert method to throw an exception
        Mockery::mock('alias:App\Models\Sale')
            ->shouldReceive('upsert')
            ->andThrow(new \Exception('Database error'));

        Log::shouldReceive('error')->once()->with('Failed to create bulk sale: Database error');

        // Act & Assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Failed to create bulk sale. Please try again.');

        $this->bulkSaleService->createBulkSale(collect([$product]), $saleDetails);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
