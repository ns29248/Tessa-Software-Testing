<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\CategoryService;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $categoryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->categoryService = new CategoryService();
    }

    public function testGetAllCategories()
    {
        // Arrange
        Category::factory()->create(['name' => 'Category 1']);
        Category::factory()->create(['name' => 'Category 2']);

        // Act
        $result = $this->categoryService->getAllCategories();

        // Assert
        $this->assertCount(2, $result);
        $this->assertEquals('Category 1', $result[0]->name);
        $this->assertEquals('Category 2', $result[1]->name);
    }

    public function testCreateCategory()
    {
        // Arrange
        $data = ['name' => 'Category 1'];

        // Act
        $result = $this->categoryService->createCategory($data);

        // Assert
        $this->assertInstanceOf(Category::class, $result);
        $this->assertEquals('Category 1', $result->name);
    }

    public function testUpdateCategory()
    {
        // Arrange
        $category = Category::factory()->create(['name' => 'Old Category Name']);
        $data = ['name' => 'Updated Category Name'];

        // Act
        $result = $this->categoryService->updateCategory($category, $data);

        // Assert
        $this->assertInstanceOf(Category::class, $result);
        $this->assertEquals('Updated Category Name', $result->name);
    }

    public function testDeleteCategory()
    {
        // Arrange
        $category = Category::factory()->create(['name' => 'Category Name']);

        // Act
        $this->categoryService->deleteCategory($category);

        // Assert
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
