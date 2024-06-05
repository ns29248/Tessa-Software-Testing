<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\CourseService;
use App\Models\Course;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class CourseServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $courseService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->courseService = new CourseService();
    }

    public function testGetAllCourses()
    {
        // Arrange
        Course::factory()->count(3)->create();

        // Act
        $result = $this->courseService->getAllCourses();

        // Assert
        $this->assertCount(3, $result);
    }

    public function testCreateCourse()
    {
        // Arrange
        $data = [
            'name' => 'Test Course',
            'description' => 'Test Description',
            'category' => 'Test Category',
        ];
        $imageNames = ['image1.jpg', 'image2.jpg'];

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();

        // Act
        $result = $this->courseService->createCourse($data, $imageNames);

        // Assert
        $this->assertInstanceOf(Course::class, $result);
        $this->assertEquals('Test Course', $result->name);
        $this->assertEquals('Test Description', $result->description);
        $this->assertEquals('Test Category', $result->category);
        $this->assertCount(2, $result->image);
    }

    public function testCreateCourseThrowsException()
    {
        // Arrange
        $data = [
            'name' => 'Test Course',
            'description' => 'Test Description',
            'category' => 'Test Category',
        ];
        $imageNames = ['image1.jpg', 'image2.jpg'];

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once()->andThrow(new Exception('Error creating course'));
        DB::shouldReceive('rollBack')->once();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Failed to add course: Error creating course');

        // Act
        $this->courseService->createCourse($data, $imageNames);
    }

    public function testUpdateCourse()
    {
        // Arrange
        $course = Course::factory()->create([
            'name' => 'Old Course',
            'description' => 'Old Description',
            'category' => 'Old Category',
        ]);
        $data = [
            'name' => 'Updated Course',
            'description' => 'Updated Description',
            'category' => 'Updated Category',
        ];
        $imageNames = ['image1.jpg', 'image2.jpg'];

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once();

        // Act
        $this->courseService->updateCourse($course, $data, $imageNames);

        // Assert
        $course->refresh();
        $this->assertEquals('Updated Course', $course->name);
        $this->assertEquals('Updated Description', $course->description);
        $this->assertEquals('Updated Category', $course->category);
        $this->assertCount(2, $course->image);
    }

    public function testUpdateCourseThrowsException()
    {
        // Arrange
        $course = Course::factory()->create([
            'name' => 'Old Course',
            'description' => 'Old Description',
            'category' => 'Old Category',
        ]);
        $data = [
            'name' => 'Updated Course',
            'description' => 'Updated Description',
            'category' => 'Updated Category',
        ];
        $imageNames = ['image1.jpg', 'image2.jpg'];

        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('commit')->once()->andThrow(new Exception('Error updating course'));
        DB::shouldReceive('rollBack')->once();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Failed to update course: Error updating course');

        // Act
        $this->courseService->updateCourse($course, $data, $imageNames);
    }

    public function testDeleteCourse()
    {
        // Arrange
        $course = Course::factory()->create();

        // Act
        $this->courseService->deleteCourse($course);

        // Assert
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
