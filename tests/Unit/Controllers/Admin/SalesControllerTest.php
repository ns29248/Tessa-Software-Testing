<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Requests\SaleRequest;
use App\Models\Product;
use App\Models\Sale;
use App\Services\SalesService;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Mockery;

class SalesControllerTest extends TestCase
{
    public function testIndex()
    {
        // Arrange
        $sales = collect([(object)['id' => 1, 'name' => 'Sale 1']]);

        $mockSalesService = Mockery::mock(SalesService::class);
        $mockSalesService->shouldReceive('getAllSales')
            ->once()
            ->andReturn($sales);

        $controller = new SalesController($mockSalesService);

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.sale', ['sales' => $sales])
            ->andReturnSelf();

        // Act
        $response = $controller->index();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.sale', $response->getName());
        $this->assertArrayHasKey('sales', $response->getData());
        $this->assertCount(1, $response->getData()['sales']);
    }

    public function testCreate()
    {
        // Arrange
        $product = new Product(['id' => 1, 'name' => 'Product 1']);

        $controller = new SalesController(Mockery::mock(SalesService::class));

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.create-sale', ['product' => $product])
            ->andReturnSelf();

        // Act
        $response = $controller->create($product);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.create-sale', $response->getName());
        $this->assertArrayHasKey('product', $response->getData());
        $this->assertEquals($product, $response->getData()['product']);
    }

    public function testStore()
    {
        // Arrange
        $validatedData = ['name' => 'New Sale'];

        $mockSalesService = Mockery::mock(SalesService::class);
        $mockSalesService->shouldReceive('createSale')
            ->with($validatedData)
            ->once()
            ->andReturnSelf();

        $request = Mockery::mock(SaleRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        $controller = new SalesController($mockSalesService);

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('sales.index'), $response->getTargetUrl());
        $this->assertEquals('Sale added successfully.', Session::get('success'));
    }

    public function testShow()
    {
        // Arrange
        $sale = new Sale(['id' => 1, 'name' => 'Sale 1']);

        $mockSalesService = Mockery::mock(SalesService::class);
        $mockSalesService->shouldReceive('getSaleById')
            ->with($sale->id)
            ->once()
            ->andReturn($sale);

        $controller = new SalesController($mockSalesService);

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.sale.show', ['sale' => $sale])
            ->andReturnSelf();

        // Act
        $response = $controller->show($sale);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.sale.show', $response->getName());
        $this->assertArrayHasKey('sale', $response->getData());
        $this->assertEquals($sale, $response->getData()['sale']);
    }

    public function testEdit()
    {
        // Arrange
        $sale = new Sale(['id' => 1, 'name' => 'Sale 1']);

        $controller = new SalesController(Mockery::mock(SalesService::class));

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.sale.edit', ['sale' => $sale])
            ->andReturnSelf();

        // Act
        $response = $controller->edit($sale);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.sale.edit', $response->getName());
        $this->assertArrayHasKey('sale', $response->getData());
        $this->assertEquals($sale, $response->getData()['sale']);
    }

    public function testUpdate()
    {
        // Arrange
        $sale = new Sale(['id' => 1, 'name' => 'Sale 1']);
        $validatedData = ['name' => 'Updated Sale'];

        $mockSalesService = Mockery::mock(SalesService::class);
        $mockSalesService->shouldReceive('updateSale')
            ->with($sale, $validatedData)
            ->once()
            ->andReturnSelf();

        $request = Mockery::mock(SaleRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        $controller = new SalesController($mockSalesService);

        // Act
        $response = $controller->update($request, $sale);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('sales.index'), $response->getTargetUrl());
        $this->assertEquals('Sale updated successfully.', Session::get('success'));
    }

    public function testDestroy()
    {
        // Arrange
        $sale = new Sale(['id' => 1, 'name' => 'Sale 1']);

        $mockSalesService = Mockery::mock(SalesService::class);
        $mockSalesService->shouldReceive('deleteSale')
            ->with($sale)
            ->once()
            ->andReturnSelf();

        $controller = new SalesController($mockSalesService);

        // Act
        $response = $controller->destroy($sale);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('sales.index'), $response->getTargetUrl());
        $this->assertEquals('Sale product deleted successfully.', Session::get('success'));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
