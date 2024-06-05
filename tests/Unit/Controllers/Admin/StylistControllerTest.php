<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use App\Http\Controllers\Admin\StylistController;
use App\Models\StylistProfile;
use App\Services\StylistService;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Mockery;

class StylistControllerTest extends TestCase
{
    public function testIndex()
    {
        // Arrange
        $stylists = collect([(object)['id' => 1, 'name' => 'Stylist 1']]);

        $mockStylistService = Mockery::mock(StylistService::class);
        $mockStylistService->shouldReceive('getAllStylists')
            ->once()
            ->andReturn($stylists);

        $controller = new StylistController($mockStylistService);

        // Act
        $response = $controller->index();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.stylists', $response->getName());
        $this->assertArrayHasKey('stylists', $response->getData());
        $this->assertCount(1, $response->getData()['stylists']);
    }

    public function testShow()
    {
        // Arrange
        $stylist = new StylistProfile(['id' => 1, 'name' => 'Stylist 1']);

        $controller = new StylistController(Mockery::mock(StylistService::class));

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.show-stylist', ['stylist' => $stylist])
            ->andReturnSelf();

        // Act
        $response = $controller->show($stylist);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.show-stylist', $response->getName());
        $this->assertArrayHasKey('stylist', $response->getData());
        $this->assertEquals($stylist, $response->getData()['stylist']);
    }

    public function testDestroy()
    {
        // Arrange
        $stylist = new StylistProfile(['id' => 1, 'name' => 'Stylist 1']);

        $mockStylistService = Mockery::mock(StylistService::class);
        $mockStylistService->shouldReceive('deleteStylist')
            ->with($stylist)
            ->once()
            ->andReturnSelf();

        $controller = new StylistController($mockStylistService);

        // Act
        $response = $controller->destroy($stylist);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('Stylist deleted successfully', Session::get('success'));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
