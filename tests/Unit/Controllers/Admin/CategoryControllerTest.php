<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Session;
use Mockery;
use Illuminate\View\View;

class CategoryControllerTest extends TestCase
{
    public function testIndex()
    {
        // Arrange
        $categories = collect([
            (object)['id' => 1, 'name' => 'Category 1'],
            (object)['id' => 2, 'name' => 'Category 2'],
        ]);

        $mockCategoryService = Mockery::mock(CategoryService::class);
        $mockCategoryService->shouldReceive('getAllCategories')
            ->once()
            ->andReturn($categories);

        $controller = new CategoryController($mockCategoryService);

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.category', ['categories' => $categories])
            ->andReturnSelf();

        // Act
        $response = $controller->index();

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.category', $response->getName());
        $this->assertArrayHasKey('categories', $response->getData());
        $this->assertCount(2, $response->getData()['categories']);
    }

    public function testStore()
    {
        // Arrange
        $validatedData = ['name' => 'New Category'];
        $category = Mockery::mock(Category::class)->makePartial();
        $category->shouldReceive('getRouteKey')->andReturn(1);

        $mockCategoryService = Mockery::mock(CategoryService::class);
        $mockCategoryService->shouldReceive('createCategory')
            ->with($validatedData)
            ->once()
            ->andReturn($category);

        $request = Mockery::mock(CategoryRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        $controller = new CategoryController($mockCategoryService);

        // Act
        $response = $controller->store($request);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('categories.edit', $category), $response->getTargetUrl());
        $this->assertEquals('Category created successfully', Session::get('success'));
    }

    public function testEdit()
    {
        // Arrange
        $category = Category::factory()->make(['id' => 1, 'name' => 'Category 1']);

        $controller = new CategoryController(Mockery::mock(CategoryService::class));

        // Mock the view
        $mockView = Mockery::mock(View::class);
        $mockView->shouldReceive('make')
            ->with('admin.edit-category', ['category' => $category])
            ->andReturnSelf();

        // Act
        $response = $controller->edit($category);

        // Assert
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('admin.edit-category', $response->getName());
        $this->assertArrayHasKey('category', $response->getData());
        $this->assertEquals($category, $response->getData()['category']);
    }

    public function testUpdate()
    {
        // Arrange
        $category = Category::factory()->make(['id' => 1, 'name' => 'Category 1']);
        $validatedData = ['name' => 'Updated Category'];

        $mockCategoryService = Mockery::mock(CategoryService::class);
        $mockCategoryService->shouldReceive('updateCategory')
            ->with($category, $validatedData)
            ->once()
            ->andReturnSelf();

        $request = Mockery::mock(CategoryRequest::class);
        $request->shouldReceive('validated')
            ->once()
            ->andReturn($validatedData);

        $controller = new CategoryController($mockCategoryService);

        // Act
        $response = $controller->update($request, $category);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('categories.edit', $category), $response->getTargetUrl());
        $this->assertEquals('Category updated successfully', Session::get('success'));
    }

    public function testDestroy()
    {
        // Arrange
        $category = Category::factory()->make(['id' => 1, 'name' => 'Category 1']);

        $mockCategoryService = Mockery::mock(CategoryService::class);
        $mockCategoryService->shouldReceive('deleteCategory')
            ->with($category)
            ->once()
            ->andReturnSelf();

        $controller = new CategoryController($mockCategoryService);

        // Act
        $response = $controller->destroy($category);

        // Assert
        $this->assertTrue($response->isRedirection());
        $this->assertEquals(route('categories.index'), $response->getTargetUrl());
        $this->assertEquals('Category deleted successfully', Session::get('success'));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
