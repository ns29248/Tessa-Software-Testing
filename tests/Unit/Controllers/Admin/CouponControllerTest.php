<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Services\CouponService;
use Illuminate\Support\Facades\Session;
use Mockery;
use Illuminate\View\View;

class CouponControllerTest extends TestCase
{
    public function testIndex()
    {
        // Arrange
        $coupons = collect([
            (object)['id' => 1, 'code' => 'COUPON1'],
            (object)['id' => 2, 'code' => 'COUPON2'],
        ]);

        $mockCouponService = Mockery::mock(CouponService::class);
        $mockCouponService->shouldReceive('getAllCoupons')
            ->once()
            ->andReturn($coupons);

        $controller = new CouponController($mockCouponService);

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.coupon', ['coupons' => $coupons])
            ->andReturnSelf();

        // Act
        $response = $controller->index();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.coupon', $response->getName());
        $this->assertArrayHasKey('coupons', $response->getData());
        $this->assertCount(2, $response->getData()['coupons']);
    }

    public function testStore()
    {
        // Arrange
        $validatedData = ['code' => 'NEWCOUPON'];

        $mockCouponService = Mockery::mock(CouponService::class);
        $mockCouponService->shouldReceive('createCoupon')
            ->with($validatedData)
            ->once()
            ->andReturnSelf();

        $request = Mockery::mock(CouponRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        $controller = new CouponController($mockCouponService);

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('Coupon created successfully.', Session::get('message'));
    }

    public function testStoreWithException()
    {
        // Arrange
        $validatedData = ['code' => 'NEWCOUPON'];

        $mockCouponService = Mockery::mock(CouponService::class);
        $mockCouponService->shouldReceive('createCoupon')
            ->with($validatedData)
            ->once()
            ->andThrow(new \Exception('An error occurred'));

        $request = Mockery::mock(CouponRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        $controller = new CouponController($mockCouponService);

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('Error creating coupon: An error occurred', Session::get('error'));
    }

    public function testShow()
    {
        // Arrange
        $coupon = Coupon::factory()->make(['id' => 1, 'code' => 'COUPON1']);

        $mockCouponService = Mockery::mock(CouponService::class);
        $mockCouponService->shouldReceive('getCoupon')
            ->with($coupon)
            ->once()
            ->andReturn($coupon);

        $controller = new CouponController($mockCouponService);

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.show-coupon', ['coupon' => $coupon])
            ->andReturnSelf();

        // Act
        $response = $controller->show($coupon);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.show-coupon', $response->getName());
        $this->assertArrayHasKey('coupon', $response->getData());
        $this->assertEquals($coupon, $response->getData()['coupon']);
    }

    public function testEdit()
    {
        // Arrange
        $coupon = Coupon::factory()->make(['id' => 1, 'code' => 'COUPON1']);

        $mockCouponService = Mockery::mock(CouponService::class);
        $mockCouponService->shouldReceive('getCoupon')
            ->with($coupon)
            ->once()
            ->andReturn($coupon);

        $controller = new CouponController($mockCouponService);

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.edit-coupon', ['coupon' => $coupon])
            ->andReturnSelf();

        // Act
        $response = $controller->edit($coupon);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.edit-coupon', $response->getName());
        $this->assertArrayHasKey('coupon', $response->getData());
        $this->assertEquals($coupon, $response->getData()['coupon']);
    }

    public function testUpdate()
    {
        // Arrange
        $coupon = Coupon::factory()->make(['id' => 1, 'code' => 'COUPON1']);
        $validatedData = ['code' => 'UPDATEDCOUPON'];

        $mockCouponService = Mockery::mock(CouponService::class);
        $mockCouponService->shouldReceive('updateCoupon')
            ->with($coupon, $validatedData)
            ->once()
            ->andReturnSelf();

        $request = Mockery::mock(CouponRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        $controller = new CouponController($mockCouponService);

        // Act
        $response = $controller->update($request, $coupon);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('Coupon updated successfully.', Session::get('message'));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
