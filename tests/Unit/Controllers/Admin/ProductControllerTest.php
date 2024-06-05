<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mockery;

class ProductControllerTest extends TestCase
{
    public function testIndex()
    {
        // Arrange
        $data = [
            'brands' => collect([(object)['id' => 1, 'name' => 'Brand 1']]),
            'categories' => collect([(object)['id' => 1, 'name' => 'Category 1']])
        ];
        $products = collect([(object)['id' => 1, 'name' => 'Product 1']]);

        $mockProductService = Mockery::mock(ProductService::class);
        $mockProductService->shouldReceive('getAllBrandsAndCategories')
            ->once()
            ->andReturn($data);
        $mockProductService->shouldReceive('getProducts')
            ->once()
            ->andReturn($mockProductService);
        $mockProductService->shouldReceive('get')
            ->once()
            ->andReturn($products);

        $controller = new ProductController($mockProductService);

        // Act
        $response = $controller->index();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.product', $response->getName());
        $this->assertArrayHasKey('brands', $response->getData());
        $this->assertArrayHasKey('categories', $response->getData());
        $this->assertArrayHasKey('products', $response->getData());
        $this->assertCount(1, $response->getData()['brands']);
        $this->assertCount(1, $response->getData()['categories']);
        $this->assertCount(1, $response->getData()['products']);
    }

    public function testStore()
    {
        // Arrange
        $validatedData = ['name' => 'New Product'];
        $imageData = 'image data';

        $mockProductService = Mockery::mock(ProductService::class);
        $mockProductService->shouldReceive('createProduct')
            ->with($validatedData, $imageData)
            ->once()
            ->andReturnSelf();

        $request = Mockery::mock(ProductRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);
        $request->shouldReceive('input')
            ->with('image')
            ->once()
            ->andReturn($imageData);

        $controller = new ProductController($mockProductService);

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('Product Added Successfully', Session::get('message'));
    }

    public function testShow()
    {
        // Arrange
        $product = Product::factory()->make(['id' => 1, 'name' => 'Product 1']);

        $controller = new ProductController(Mockery::mock(ProductService::class));

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.show-product', ['product' => $product])
            ->andReturnSelf();

        // Act
        $response = $controller->show($product);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.show-product', $response->getName());
        $this->assertArrayHasKey('product', $response->getData());
        $this->assertEquals($product, $response->getData()['product']);
    }

    public function testEdit()
    {
        // Arrange
        $product = Product::factory()->make(['id' => 1, 'name' => 'Product 1']);
        $data = [
            'brands' => collect([(object)['id' => 1, 'name' => 'Brand 1']]),
            'categories' => collect([(object)['id' => 1, 'name' => 'Category 1']])
        ];

        $mockProductService = Mockery::mock(ProductService::class);
        $mockProductService->shouldReceive('getAllBrandsAndCategories')
            ->twice()
            ->andReturn($data);

        $controller = new ProductController($mockProductService);

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.edit-product', ['brands' => $data['brands'], 'categories' => $data['categories']])
            ->andReturnSelf();

        // Act
        $response = $controller->edit($product);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.edit-product', $response->getName());
        $this->assertArrayHasKey('brands', $response->getData());
        $this->assertArrayHasKey('categories', $response->getData());
    }

    public function testUpdate()
    {
        // Arrange
        $product = Product::factory()->make(['id' => 1, 'name' => 'Product 1']);
        $validatedData = ['name' => 'Updated Product'];
        $imageData = 'updated image data';

        $mockProductService = Mockery::mock(ProductService::class);
        $mockProductService->shouldReceive('updateProduct')
            ->with($product, $validatedData, $imageData)
            ->once()
            ->andReturnSelf();

        $request = Mockery::mock(ProductRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);
        $request->shouldReceive('input')
            ->with('image')
            ->once()
            ->andReturn($imageData);

        $controller = new ProductController($mockProductService);

        // Act
        $response = $controller->update($request, $product);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('Product Updated Successfully', Session::get('message'));
    }

    public function testDestroy()
    {
        // Arrange
        $product = Product::factory()->make(['id' => 1, 'name' => 'Product 1']);

        $mockProductService = Mockery::mock(ProductService::class);
        $mockProductService->shouldReceive('deleteProduct')
            ->with($product)
            ->once()
            ->andReturnSelf();

        $controller = new ProductController($mockProductService);

        // Act
        $response = $controller->destroy($product);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('products.index'), $response->getTargetUrl());
        $this->assertEquals('Product deleted successfully', Session::get('success'));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
