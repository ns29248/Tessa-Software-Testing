<?php

namespace Tests\Unit\Controllers\Admin;

use App\Http\Controllers\Admin\OrderController;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    protected $orderService;
    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->orderService = Mockery::mock(OrderService::class);
        $this->controller = new OrderController($this->orderService);
    }

    public function testIndex()
    {
        $orders = collect(['order1', 'order2', 'order3']);
        $orderItems = collect(['item1', 'item2', 'item3']);
        $this->orderService->shouldReceive('getAllOrdersByStatus')->once()->with(0)->andReturn($orders);
        $this->orderService->shouldReceive('getOrderItems')->once()->andReturn($orderItems);

        $response = $this->controller->index();

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.order', $response->getName());
        $this->assertArrayHasKey('orders', $response->getData());
        $this->assertArrayHasKey('orderItems', $response->getData());
        $this->assertEquals($orders, $response->getData()['orders']);
        $this->assertEquals($orderItems, $response->getData()['orderItems']);
    }

    public function testHistory()
    {
        $orders = collect(['order1', 'order2', 'order3']);
        $orderItems = collect(['item1', 'item2', 'item3']);
        $this->orderService->shouldReceive('getAllOrdersByStatus')->once()->with(1)->andReturn($orders);
        $this->orderService->shouldReceive('getOrderItems')->once()->andReturn($orderItems);

        $response = $this->controller->history();

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.order-history', $response->getName());
        $this->assertArrayHasKey('orders', $response->getData());
        $this->assertArrayHasKey('orderItems', $response->getData());
        $this->assertEquals($orders, $response->getData()['orders']);
        $this->assertEquals($orderItems, $response->getData()['orderItems']);
    }

    public function testShow()
    {
        $order = ['id' => 1, 'name' => 'Test Order'];
        $this->orderService->shouldReceive('getOrderById')->once()->with('1')->andReturn(['order' => $order]);

        $response = $this->controller->show('1');

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.show-order', $response->getName());
        $this->assertArrayHasKey('order', $response->getData());
        $this->assertEquals($order, $response->getData()['order']);
    }

    public function testUpdate()
    {
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('get')->with('order_status')->andReturn('updated');
        $request->shouldReceive('all')->andReturn(['order_status' => 'updated']); // Add this line

        $this->orderService->shouldReceive('updateOrderStatus')->once()->with('1', 'updated')->andReturn(true);

        $response = $this->controller->update($request, '1');

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Order updated successfully', session('message'));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
