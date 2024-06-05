<?php

namespace Controllers\Main;

use App\Http\Controllers\Main\OrderController;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    public function testOrderDetails()
    {
        // Arrange
        $orderId = 1;
        $order = (object)['id' => $orderId, 'details' => 'Order details'];

        $mockOrderService = Mockery::mock(OrderService::class);
        $mockOrderService->shouldReceive('getOrderById')
            ->with($orderId)
            ->once()
            ->andReturn(['order' => $order]);

        $controller = new OrderController($mockOrderService);

        // Act
        $response = $controller->orderDetails($orderId);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('main.order.order-details', $response->getName());
        $this->assertArrayHasKey('order', $response->getData());
        $this->assertEquals($order, $response->getData()['order']);
    }

    public function testMyOrders()
    {
        // Arrange
        $userId = 1;
        $orders = collect([
            (object)['id' => 1, 'details' => 'Order 1 details'],
            (object)['id' => 2, 'details' => 'Order 2 details'],
        ]);

        $mockOrderService = Mockery::mock(OrderService::class);
        $mockOrderService->shouldReceive('getOrderByUserId')
            ->with($userId)
            ->once()
            ->andReturn($orders);

        Auth::shouldReceive('id')
            ->once()
            ->andReturn($userId);

        $controller = new OrderController($mockOrderService);

        // Act
        $response = $controller->myOrders();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('main.order.my-orders', $response->getName());
        $this->assertArrayHasKey('orders', $response->getData());
        $this->assertCount(2, $response->getData()['orders']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
