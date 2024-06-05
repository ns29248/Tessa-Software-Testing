<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\CouponService;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CouponServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $couponService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->couponService = new CouponService();
    }

    public function testGetAllCoupons()
    {
        // Arrange
        Coupon::factory()->count(3)->create();

        // Act
        $result = $this->couponService->getAllCoupons();

        // Assert
        $this->assertCount(3, $result);
    }

    public function testCreateCoupon()
    {
        // Arrange
        $data = [
            'code' => 'COUPON1',
            'type' => 'fixed',
            'value' => 10,
            'quantity' => 100,
            'expiration_date' => now()->addDays(10)
        ];

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();

        // Act
        $result = $this->couponService->createCoupon($data);

        // Assert
        $this->assertInstanceOf(Coupon::class, $result);
        $this->assertEquals('COUPON1', $result->code);
        $this->assertEquals('fixed', $result->type);
        $this->assertEquals(10, $result->value);
        $this->assertEquals(100, $result->quantity);
        $this->assertEquals(now()->addDays(10)->toDateString(), $result->expiration_date->toDateString());
    }

    public function testCreateCouponThrowsException()
    {
        // Arrange
        $data = [
            'code' => 'COUPON1',
            'type' => 'fixed',
            'value' => 10,
            'quantity' => 100,
            'expiration_date' => now()->addDays(10)
        ];

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once()->andThrow(new Exception('Error creating coupon'));
        DB::shouldReceive('rollBack')->once();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Failed to create coupon. Error: Error creating coupon');

        // Act
        $this->couponService->createCoupon($data);
    }

    public function testUpdateCoupon()
    {
        // Arrange
        $coupon = Coupon::factory()->create([
            'code' => 'COUPON1',
            'type' => 'fixed',
            'value' => 10,
            'quantity' => 100,
            'expiration_date' => now()->addDays(10)
        ]);
        $data = [
            'code' => 'UPDATED_COUPON',
            'type' => 'percentage',
            'value' => 20,
            'quantity' => 50,
            'expiration_date' => now()->addDays(20)
        ];

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();

        // Act
        $this->couponService->updateCoupon($coupon, $data);

        // Assert
        $coupon->refresh();
        $this->assertEquals('UPDATED_COUPON', $coupon->code);
        $this->assertEquals('percentage', $coupon->type);
        $this->assertEquals(20, $coupon->value);
        $this->assertEquals(50, $coupon->quantity);
        $this->assertEquals(now()->addDays(20)->toDateString(), $coupon->expiration_date->toDateString());
    }

    public function testUpdateCouponThrowsException()
    {
        // Arrange
        $coupon = Coupon::factory()->create([
            'code' => 'COUPON1',
            'type' => 'fixed',
            'value' => 10,
            'quantity' => 100,
            'expiration_date' => now()->addDays(10)
        ]);
        $data = [
            'code' => 'UPDATED_COUPON',
            'type' => 'percentage',
            'value' => 20,
            'quantity' => 50,
            'expiration_date' => now()->addDays(20)
        ];

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once()->andThrow(new Exception('Error updating coupon'));
        DB::shouldReceive('rollBack')->once();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Failed to update coupon. Error: Error updating coupon');

        // Act
        $this->couponService->updateCoupon($coupon, $data);
    }

    public function testGetCoupon()
    {
        // Arrange
        $coupon = Coupon::factory()->create(['code' => 'COUPON1']);

        // Act
        $result = $this->couponService->getCoupon($coupon);

        // Assert
        $this->assertEquals('COUPON1', $result->code);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
