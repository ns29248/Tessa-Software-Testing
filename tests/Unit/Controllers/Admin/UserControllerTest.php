<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use App\Http\Controllers\Admin\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\View\View;
use Mockery;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // Arrange
        $users = User::factory()->count(3)->create();

        $controller = new UserController();

        // Act
        $response = $controller->index();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.users', $response->name());
        $this->assertArrayHasKey('users', $response->getData());
        $this->assertCount(3, $response->getData()['users']);
    }

    public function testDestroy()
    {
        // Arrange
        $user = User::factory()->create();

        $controller = new UserController();

        // Act
        $response = $controller->destroy($user);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(url()->previous(), $response->getTargetUrl());
        $this->assertEquals('User deleted successfully', session('success'));
    }

    public function testShow()
    {
        // Arrange
        $user = User::factory()->create();

        $controller = new UserController();

        // Act
        $response = $controller->show($user);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.show-user', $response->name());
        $this->assertArrayHasKey('user', $response->getData());
        $this->assertEquals($user->id, $response->getData()['user']->id);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
