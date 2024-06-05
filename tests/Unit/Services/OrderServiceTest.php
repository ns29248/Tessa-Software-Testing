<?php

namespace Tests\Unit\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;
use Illuminate\Support\Facades\DB;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $orderService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->orderService = new OrderService();
    }

    public function testGetAllOrdersByStatus()
    {
        // Arrange
        $status = 1; // Use an integer value for status
        Order::factory()->create(['status' => $status]);

        // Act
        $orders = $this->orderService->getAllOrdersByStatus($status);

        // Assert
        $this->assertCount(1, $orders);
    }

    public function testGetOrderItems()
    {
        // Arrange
        Item::factory()->count(3)->create();

        // Act
        $items = $this->orderService->getOrderItems();

        // Assert
        $this->assertCount(3, $items);
    }

    public function testGetOrderById()
    {
        // Arrange
        $order = Order::factory()->create();
        Item::factory()->create(['order_id' => $order->id]);

        // Act
        $result = $this->orderService->getOrderById($order->id);

        // Assert
        $this->assertEquals($order->id, $result['order']->id);
    }

    public function testGetOrderByUserId()
    {
        // Arrange
        $user = User::factory()->create();
        Order::factory()->create(['user_id' => $user->id]);

        // Act
        $orders = $this->orderService->getOrderByUserId($user->id);

        // Assert
        $this->assertCount(1, $orders);
    }

    public function testUpdateOrderStatus()
    {
        // Arrange
        $order = Order::factory()->create();
        $newStatus = 2; // Use an integer value for status

        // Act
        $this->orderService->updateOrderStatus($order->id, $newStatus);

        // Assert
        $this->assertEquals($newStatus, $order->fresh()->status);
    }

    public function testCreateOrder()
    {
        // Arrange
        $user = User::factory()->create();
        $total = 100;

        // Act
        $order = $this->orderService->createOrder($user->id, $total);

        // Assert
        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals($total, $order->total);
    }

    public function testInsertOrderItems()
    {
        // Arrange
        $order = Order::factory()->create();
        $cartItems = Cart::factory()->count(2)->create();

        // Act
        $this->orderService->insertOrderItems($order, $cartItems);

        // Assert
        $this->assertCount(2, $order->item);
    }

    public function testClearUserCart()
    {
        // Arrange
        $user = User::factory()->create();
        Cart::factory()->count(2)->create(['user_id' => $user->id]);

        // Act
        $this->orderService->clearUserCart($user->id);

        // Assert
        $this->assertCount(0, Cart::where('user_id', $user->id)->get());
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
