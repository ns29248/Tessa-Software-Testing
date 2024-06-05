<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use App\Http\Controllers\Admin\RequestStylistController;
use App\Http\Requests\RequestStylistRequest;
use App\Models\RequestStylist;
use App\Models\User;
use App\Services\RequestStylistService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Mockery;

class RequestStylistControllerTest extends TestCase
{
    public function testIndex()
    {
        // Arrange
        $requests = collect([(object)['id' => 1, 'name' => 'Request 1']]);

        $mockRequestStylistService = Mockery::mock(RequestStylistService::class);
        $mockRequestStylistService->shouldReceive('getAllRequests')
            ->once()
            ->andReturn($requests);

        $controller = new RequestStylistController($mockRequestStylistService);

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.stylist-request', ['requests' => $requests])
            ->andReturnSelf();

        // Act
        $response = $controller->index();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.stylist-request', $response->getName());
        $this->assertArrayHasKey('requests', $response->getData());
        $this->assertCount(1, $response->getData()['requests']);
    }

    public function testStore()
    {
        // Arrange
        $validatedData = ['name' => 'New Stylist Request'];
        $user = Mockery::mock(User::class);

        $mockRequestStylistService = Mockery::mock(RequestStylistService::class);
        $mockRequestStylistService->shouldReceive('createRequest')
            ->with($user, $validatedData)
            ->once()
            ->andReturnSelf();

        $request = Mockery::mock(RequestStylistRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        Auth::shouldReceive('user')
            ->once()
            ->andReturn($user);

        $controller = new RequestStylistController($mockRequestStylistService);

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('show_products'), $response->getTargetUrl());
        $this->assertEquals('Request Made Successfully', Session::get('message'));
    }

    public function testShow()
    {
        // Arrange
        $request = new RequestStylist(['id' => 1, 'name' => 'Request 1']);

        $controller = new RequestStylistController(Mockery::mock(RequestStylistService::class));

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.show-stylist-request', ['request' => $request])
            ->andReturnSelf();

        // Act
        $response = $controller->show($request);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.show-stylist-request', $response->getName());
        $this->assertArrayHasKey('request', $response->getData());
        $this->assertEquals($request, $response->getData()['request']);
    }

    public function testUpdate()
    {
        // Arrange
        $request = new RequestStylist(['id' => 1, 'name' => 'Request 1']);

        $mockRequestStylistService = Mockery::mock(RequestStylistService::class);
        $mockRequestStylistService->shouldReceive('approveRequest')
            ->with($request)
            ->once()
            ->andReturnSelf();

        $controller = new RequestStylistController($mockRequestStylistService);

        // Act
        $response = $controller->update($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('Request approved successfully', Session::get('success'));
    }

    public function testUpdateWithException()
    {
        // Arrange
        $request = new RequestStylist(['id' => 1, 'name' => 'Request 1']);

        $mockRequestStylistService = Mockery::mock(RequestStylistService::class);
        $mockRequestStylistService->shouldReceive('approveRequest')
            ->with($request)
            ->once()
            ->andThrow(new \Exception('An error occurred'));

        $controller = new RequestStylistController($mockRequestStylistService);

        // Act
        $response = $controller->update($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('Unable to approve request: An error occurred', Session::get('error'));
    }

    public function testDestroy()
    {
        // Arrange
        $request = new RequestStylist(['id' => 1, 'name' => 'Request 1']);

        $mockRequestStylistService = Mockery::mock(RequestStylistService::class);
        $mockRequestStylistService->shouldReceive('denyRequest')
            ->with($request)
            ->once()
            ->andReturnSelf();

        $controller = new RequestStylistController($mockRequestStylistService);

        // Act
        $response = $controller->destroy($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('Request denied successfully', Session::get('success'));
    }

    public function testDestroyWithException()
    {
        // Arrange
        $request = new RequestStylist(['id' => 1, 'name' => 'Request 1']);

        $mockRequestStylistService = Mockery::mock(RequestStylistService::class);
        $mockRequestStylistService->shouldReceive('denyRequest')
            ->with($request)
            ->once()
            ->andThrow(new \Exception('An error occurred'));

        $controller = new RequestStylistController($mockRequestStylistService);

        // Act
        $response = $controller->destroy($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('Unable to deny request: An error occurred', Session::get('error'));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
